@extends('layouts.app')

@section('content')
    <h1>Record Sale</h1>

    <form method="POST" action="{{ route('sales.store') }}">
        @csrf

        <label>Product</label>

        <select name="product_id" id="product_id" required>
            <option value="">Select Product</option>

            @foreach ($products as $product)
                <option
                    value="{{ $product->id }}"
                    data-price="{{ $product->price }}"
                    data-stock="{{ $product->stock_quantity }}"
                >
                    {{ $product->name }}
                    - Stock: {{ $product->stock_quantity }}
                    - Price: {{ number_format($product->price, 2) }}
                </option>
            @endforeach
        </select>

        <p id="stock-message"></p>

        <br>

        <label>Customer</label>

        <select name="customer_id">
            <option value="">Walk-in Customer</option>

            @foreach ($customers as $customer)
                <option value="{{ $customer->id }}">
                    {{ $customer->full_name }}
                </option>
            @endforeach
        </select>

        <br><br>

        <label>Quantity</label>
        <input
            type="number"
            name="quantity"
            id="quantity"
            min="1"
            required
        >

        <p>
            Total Price:
            <span id="total-price">0.00</span>
        </p>

        <button type="submit">Record Sale</button>
    </form>

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
                    ' - Quantity exceeds available stock.';
                stockMessage.style.color = 'red';
            } else {
                stockMessage.style.color = 'green';
            }
        }

        productSelect.addEventListener('change', calculateTotal);
        quantityInput.addEventListener('input', calculateTotal);
    </script>
@endsection