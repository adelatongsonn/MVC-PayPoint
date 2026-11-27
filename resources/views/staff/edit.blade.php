@extends('layouts.app')

@section('content')
    <h1>Edit Staff</h1>

    <form
        method="POST"
        action="{{ route('staff.update', $staff) }}"
        enctype="multipart/form-data"
    >
        @csrf
        @method('PUT')

        @include('staff.form')

        <button type="submit">Update Staff</button>
    </form>
@endsection