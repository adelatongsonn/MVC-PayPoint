<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);

        return view('products.index', compact('products'));
    }

    public function create()
    {
        $existingProducts = Product::orderBy('name')->get(['sku', 'name', 'price']);

        return view('products.create', compact('existingProducts'));
    }

    public function store(Request $request)
    {
        $name = $request->input('name');

        if (is_string($name)) {
            $request->merge(['name' => Str::squish($name)]);
        }
        $sku = $request->input('sku');

        if (is_string($sku)) {
            $sku = trim($sku);
            $request->merge(['sku' => $sku === '' ? null : strtoupper($sku)]);
        }

        $data = $request->validate([
            'sku' => ['nullable', 'string', 'max:50', Rule::exists('products', 'sku')->whereNull('deleted_at')],
            'name' => ['required', 'string', 'max:100'],
            'price' => ['required', 'numeric', 'min:0.01'],
            'stock_quantity' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        unset($data['image']);

        $product = DB::transaction(function () use ($data, $request) {
            if (isset($data['sku'])) {
                $product = Product::where('sku', $data['sku'])->lockForUpdate()->first();

                if (! $product) {
                    throw ValidationException::withMessages([
                        'sku' => 'This product is no longer available. Please select another product.',
                    ]);
                }

            } else {
                $product = $this->findProductByName($data['name']);
            }

            if ($product) {
                $product->increment('stock_quantity', $data['stock_quantity']);

                return $product;
            }

            $nextProductId = ((int) Product::withTrashed()->max('id')) + 1;

            $product = Product::create(array_merge($data, [
                'sku' => 'PRD-' . str_pad(
                    (string) $nextProductId,
                    6,
                    '0',
                    STR_PAD_LEFT
                ),
            ]));

            if ($request->hasFile('image')) {
                $product->update([
                    'image' => $request
                        ->file('image')
                        ->store('products', 'public'),
                ]);
            }

            return $product;
        });

        return redirect()
            ->route('products.index')
            ->with('success', $product->wasRecentlyCreated
                ? 'Product added successfully.'
                : 'Added '.$data['stock_quantity'].' unit(s) to '.$product->name.' ('.$product->sku.').');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $name = $request->input('name');

        if (is_string($name)) {
            $request->merge(['name' => Str::squish($name)]);
        }
        $sku = $request->input('sku');

        if (is_string($sku)) {
            $request->merge(['sku' => strtoupper(trim($sku))]);
        }

        $data = $request->validate([
            'sku' => ['required', 'string', 'max:50', 'regex:/^[A-Z0-9][A-Z0-9._-]*$/', Rule::unique('products', 'sku')->ignore($product)],
            'name' => ['required', 'string', 'max:100'],
            'price' => ['required', 'numeric', 'min:0.01'],
            'stock_quantity' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'max:2048'],
            'remove_image' => ['sometimes', 'boolean'],
        ]);

        if ($this->findProductByName($data['name'], $product->id)) {
            throw ValidationException::withMessages([
                'name' => 'A product with this name already exists. Add stock to the existing product instead.',
            ]);
        }

        unset($data['image'], $data['remove_image']);

        $previousImage = $product->image;

        if ($request->hasFile('image')) {
            $data['image'] = $request
                ->file('image')
                ->store('products', 'public');
        } elseif ($request->boolean('remove_image')) {
            $data['image'] = null;
        }

        $product->update($data);

        if ($previousImage && array_key_exists('image', $data) && $previousImage !== $data['image']) {
            Storage::disk('public')->delete($previousImage);
        }

        return redirect()
            ->route('products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Product archived successfully.');
    }

    private function findProductByName(string $name, ?int $ignoreId = null): ?Product
    {
        $normalizedName = Str::lower(Str::squish($name));

        return Product::orderBy('id')->get()->first(
            fn (Product $product): bool => $product->id !== $ignoreId
                && Str::lower(Str::squish($product->name)) === $normalizedName,
        );
    }
}
