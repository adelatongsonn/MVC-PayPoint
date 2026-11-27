@extends('layouts.app')

@section('content')
    <h1>Customer Management</h1>

    <a href="{{ route('customers.create') }}">Add Customer</a>

    <table border="1" cellpadding="8">
        <tr>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>

        @foreach ($customers as $customer)
            <tr>
                <td>{{ $customer->full_name }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->phone }}</td>
                <td>
                    <a href="{{ route('customers.edit', $customer) }}">
                        Edit
                    </a>

                    <form
                        method="POST"
                        action="{{ route('customers.destroy', $customer) }}"
                        style="display:inline"
                    >
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {{ $customers->links() }}
@endsection