@extends('layouts.app')

@section('content')
    <h1>Add Customer</h1>

    <form method="POST" action="{{ route('customers.store') }}">
        @csrf

        @include('customers.form')

        <button type="submit">Save Customer</button>
    </form>
@endsection