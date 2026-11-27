<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with([
            'product',
            'customer',
            'staff',
        ])->latest()->paginate(15);

        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $products = Product::where('stock_quantity', '>', 0)
            ->orderBy('name')
            ->get();

        $customers = Customer::orderBy('full_name')->get();

        return view('sales.create', compact(
            'products',
            'customers'
        ));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'customer_id' => ['nullable', 'exists:customers,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        DB::transaction(function () use ($data) {
            $product = Product::whereKey($data['product_id'])
                ->lockForUpdate()
                ->firstOrFail();

            if ($data['quantity'] > $product->stock_quantity) {
                throw ValidationException::withMessages([
                    'quantity' => "Only {$product->stock_quantity} item(s) are available.",
                ]);
            }

            $totalPrice = $product->price * $data['quantity'];

            Sale::create([
                'product_id' => $product->id,
                'customer_id' => $data['customer_id'] ?? null,
                'sold_by' => auth()->id(),
                'quantity' => $data['quantity'],
                'total_price' => $totalPrice,
            ]);

            $product->decrement(
                'stock_quantity',
                $data['quantity']
            );
        });

        return redirect()
            ->route('sales.index')
            ->with('success', 'Sale recorded successfully.');
    }
}