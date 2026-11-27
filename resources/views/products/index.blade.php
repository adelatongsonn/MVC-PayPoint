@extends('layouts.app')

@section('content')
    <h1>Product Management</h1>

    <a href="{{ route('products.create') }}">Add Product</a>

    <table border="1" cellpadding="8">
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Actions</th>
        </tr>

        @foreach ($products as $product)
            <tr>
                <td>
                    @if ($product->image)
                        <img
                            src="{{ asset('storage/' . $product->image) }}"
                            width="70"
                            height="70"
                            alt="{{ $product->name }}"
                        >
                    @else
                        No image
                    @endif
                </td>

                <td>{{ $product->name }}</td>
                <td>{{ number_format($product->price, 2) }}</td>
                <td>{{ $product->stock_quantity }}</td>

                <td>
                    <a href="{{ route('products.edit', $product) }}">
                        Edit
                    </a>

                    <form
                        method="POST"
                        action="{{ route('products.destroy', $product) }}"
                        style="display:inline"
                    >
                        @csrf
                        @method('DELETE')
                        <button type="submit">Archive</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {{ $products->links() }}
@endsection