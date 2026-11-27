@extends('layouts.app')

@section('content')
    <h1>Staff Management</h1>

    <a href="{{ route('staff.create') }}">Add Staff</a>

    <table border="1" cellpadding="8">
        <tr>
            <th>Avatar</th>
            <th>Full Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>

        @foreach ($staff as $member)
            <tr>
                <td>
                    @if ($member->avatar)
                        <img
                            src="{{ asset('storage/' . $member->avatar) }}"
                            width="60"
                            height="60"
                            alt="{{ $member->full_name }}"
                        >
                    @else
                        No avatar
                    @endif
                </td>

                <td>{{ $member->full_name }}</td>
                <td>{{ $member->username }}</td>
                <td>{{ $member->email }}</td>

                <td>
                    <a href="{{ route('staff.edit', $member) }}">
                        Edit
                    </a>

                    <form
                        method="POST"
                        action="{{ route('staff.destroy', $member) }}"
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

    {{ $staff->links() }}
@endsection