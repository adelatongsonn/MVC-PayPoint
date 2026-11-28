@extends('layouts.pos')

@section('title', 'Record Sale — PayPoint')
@section('page_title', 'Record Sale')
@section('page_subtitle', 'Create a new sales transaction')

@section('content')
<div class="prod-form-root">
    <div class="mb-4">
        <a href="{{ route('sales.index') }}" class="prod-back-link">
            <i class="bi bi-arrow-left" aria-hidden="true"></i>
            <span>Back to Sales History</span>
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">
            <div class="prod-form-panel">
                <div class="prod-form-panel-header">
                    <div class="d-flex align-items-center gap-3">
                        <span class="prod-form-icon-box">
                            <i class="bi bi-cart-plus" aria-hidden="true"></i>
                        </span>

                        <div>
                            <div class="prod-form-panel-title">
                                New Sales Transaction
                            </div>

                            <div class="prod-form-panel-meta">
                                Select a product and enter the quantity to record a sale
                            </div>
                        </div>
                    </div>
                </div>

                <div class="prod-form-body">
                    <form method="POST" action="{{ route('sales.store') }}">
                        @csrf

                        <div class="prod-field mb-3">
                            <label for="product_id" class="prod-label">
                                <i class="bi bi-box-seam me-1" aria-hidden="true"></i>
                                Product
                            </label>

                            <select
                                name="product_id"
                                id="product_id"
                                class="form-select prod-input @error('product_id') is-invalid @enderror"
                                required
                            >
                                <option value="">Select Product</option>

                                @foreach ($products as $product)
                                    <option
                                        value="{{ $product->id }}"
                                        data-price="{{ $product->price }}"
                                        data-stock="{{ $product->stock_quantity }}"
                                        @selected(old('product_id') == $product->id)
                                    >
                                        {{ $product->name }}
                                        — Stock: {{ $product->stock_quantity }}
                                        — Price: {{ number_format($product->price, 2) }}
                                    </option>
                                @endforeach
                            </select>

                            <div id="stock-message" class="prod-hint"></div>

                            @error('product_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="prod-field mb-3">
                            <label for="customer_id" class="prod-label">
                                <i class="bi bi-person me-1" aria-hidden="true"></i>
                                Customer
                            </label>

                            <select
                                name="customer_id"
                                id="customer_id"
                                class="form-select prod-input @error('customer_id') is-invalid @enderror"
                            >
                                <option value="">Walk-in Customer</option>

                                @foreach ($customers as $customer)
                                    <option
                                        value="{{ $customer->id }}"
                                        @selected(old('customer_id') == $customer->id)
                                    >
                                        {{ $customer->full_name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('customer_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="prod-field mb-3">
                            <label for="quantity" class="prod-label">
                                <i class="bi bi-123 me-1" aria-hidden="true"></i>
                                Quantity
                            </label>

                            <input
                                type="number"
                                name="quantity"
                                id="quantity"
                                class="form-control prod-input @error('quantity') is-invalid @enderror"
                                value="{{ old('quantity') }}"
                                min="1"
                                required
                            >

                            @error('quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="border-top pt-3 mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="prod-label mb-0">
                                    <i class="bi bi-cash-stack me-1" aria-hidden="true"></i>
                                    Total Price
                                </span>

                                <strong>
                                    <span id="total-price">0.00</span>
                                </strong>
                            </div>
                        </div>

                        <div class="prod-form-footer flex-wrap">
                            <a
                                href="{{ route('sales.index') }}"
                                class="btn prod-cancel-btn"
                            >
                                Cancel
                            </a>

                            <button
                                type="submit"
                                class="btn btn-gold prod-submit-btn"
                            >
                                <i class="bi bi-check-lg me-1" aria-hidden="true"></i>
                                Record Sale
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const productSelect = document.getElementById('product_id');
    const quantityInput = document.getElementById('quantity');
    const totalPrice = document.getElementById('total-price');
    const stockMessage = document.getElementById('stock-message');

    function calculateTotal() {
        const option =
            productSelect.options[productSelect.selectedIndex];

        if (!option || !option.dataset.price) {
            totalPrice.textContent = '0.00';
            stockMessage.textContent = '';
            return;
        }

        const price = Number(option.dataset.price);
        const stock = Number(option.dataset.stock);
        const quantity = Number(quantityInput.value || 0);

        totalPrice.textContent =
            (price * quantity).toFixed(2);

        stockMessage.textContent =
            `Available stock: ${stock}`;

        if (quantity > stock) {
            stockMessage.textContent +=
                ' — Quantity exceeds available stock.';
            stockMessage.style.color = 'red';
        } else {
            stockMessage.style.color = 'green';
        }
    }

    productSelect.addEventListener('change', calculateTotal);
    quantityInput.addEventListener('input', calculateTotal);

    calculateTotal();
</script>
@endsection