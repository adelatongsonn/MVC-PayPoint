@extends('layouts.app')

@section('content')
    <h1>Add Staff</h1>

    <form
        method="POST"
        action="{{ route('staff.store') }}"
        enctype="multipart/form-data"
    >
        @csrf

        @include('staff.form')

        <button type="submit">Save Staff</button>
    </form>
@endsection