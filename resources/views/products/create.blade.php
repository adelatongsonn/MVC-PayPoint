@extends('layouts.app')

@section('content')
    <h1>Add Product</h1>

    <form
        method="POST"
        action="{{ route('products.store') }}"
        enctype="multipart/form-data"
    >
        @csrf

        @include('products.form')

        <button type="submit">Save Product</button>
    </form>
@endsection