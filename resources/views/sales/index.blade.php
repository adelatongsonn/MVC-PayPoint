@extends('layouts.app')

@section('content')
    <h1>Sales History</h1>

    <a href="{{ route('sales.create') }}">Record New Sale</a>

    <table border="1" cellpadding="8">
        <tr>
            <th>Product</th>
            <th>Customer</th>
            <th>Staff</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Date</th>
        </tr>

        @foreach ($sales as $sale)
            <tr>
                <td>{{ $sale->product?->name ?? 'Archived Product' }}</td>
                <td>
                    {{ $sale->customer?->full_name ?? 'Walk-in Customer' }}
                </td>
                <td>
                    {{ $sale->staff?->full_name ?? 'Archived Staff' }}
                </td>
                <td>{{ $sale->quantity }}</td>
                <td>{{ number_format($sale->total_price, 2) }}</td>
                <td>{{ $sale->created_at->format('Y-m-d H:i') }}</td>
            </tr>
        @endforeach
    </table>

    {{ $sales->links() }}
@endsection