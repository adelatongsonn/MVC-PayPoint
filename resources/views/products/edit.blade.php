@extends('layouts.app')

@section('content')
    <h1>Edit Product</h1>

    <form
        method="POST"
        action="{{ route('products.update', $product) }}"
        enctype="multipart/form-data"
    >
        @csrf
        @method('PUT')

        @include('products.form')

        <button type="submit">Update Product</button>
    </form>
@endsection