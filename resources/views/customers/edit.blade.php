@extends('layouts.app')

@section('content')
    <h1>Edit Customer</h1>

    <form method="POST" action="{{ route('customers.update', $customer) }}">
        @csrf
        @method('PUT')

        @include('customers.form')

        <button type="submit">Update Customer</button>
    </form>
@endsection