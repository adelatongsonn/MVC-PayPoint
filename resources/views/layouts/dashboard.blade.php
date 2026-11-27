@extends('layouts.app')

@section('content')
    <h1>POS Dashboard</h1>

    <p>
        Welcome,
        {{ auth()->user()->full_name }}.
    </p>

    <ul>
        <li>
            <a href="{{ route('products.index') }}">
                Manage Products
            </a>
        </li>

        <li>
            <a href="{{ route('customers.index') }}">
                Manage Customers
            </a>
        </li>

        <li>
            <a href="{{ route('staff.index') }}">
                Manage Staff
            </a>
        </li>

        <li>
            <a href="{{ route('sales.create') }}">
                Record Sale
            </a>
        </li>

        <li>
            <a href="{{ route('sales.index') }}">
                Sales History
            </a>
        </li>
    </ul>
@endsections