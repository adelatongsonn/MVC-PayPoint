@extends('layouts.pos')

@section('title', 'Staff Management — PayPoint')
@section('page_title', 'Staff Management')
@section('page_subtitle', 'Manage staff accounts and access information')

@section('content')
<div class="prod-root">
    <div class="prod-page-header d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div>
            <div class="prod-section-label">MANAGEMENT</div>
            <h2 class="prod-page-title mb-0">Staff Directory</h2>
        </div>

        <a href="{{ route('staff.create') }}" class="btn btn-gold prod-btn-primary">
            <i class="bi bi-person-plus me-1" aria-hidden="true"></i>
            Add Staff
        </a>
    </div>

    <div class="prod-panel">
        <div class="prod-panel-header d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <span class="prod-icon-box">
                    <i class="bi bi-people" aria-hidden="true"></i>
                </span>

                <div>
                    <div class="prod-panel-title">All Staff Members</div>

                    <div class="prod-panel-meta">
                        @if ($staff->total() > 0)
                            Showing {{ $staff->firstItem() }}–{{ $staff->lastItem() }}
                            of {{ $staff->total() }} staff member(s)
                        @else
                            No staff members found
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table prod-table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th scope="col" class="ps-4">Staff Member</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col" class="text-end pe-4" style="width: 220px;">
                            Actions
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($staff as $member)
                        <tr class="prod-row">
                            <td class="ps-4">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="staff-avatar">
                                        @if ($member->avatar)
                                            <img
                                                src="{{ asset('storage/' . $member->avatar) }}"
                                                alt="{{ $member->full_name }}"
                                                class="w-100 h-100"
                                                style="object-fit: cover;"
                                            >
                                        @else
                                            <i class="bi bi-person" aria-hidden="true"></i>
                                        @endif
                                    </span>

                                    <span class="prod-name text-break">
                                        {{ $member->full_name }}
                                    </span>
                                </div>
                            </td>

                            <td class="small">
                                <span class="badge badge-tamaraw">
                                    {{ $member->username }}
                                </span>
                            </td>

                            <td class="small text-break">
                                {{ $member->email }}
                            </td>

                            <td class="text-end pe-4">
                                <div class="d-inline-flex gap-2">
                                    <a
                                        href="{{ route('staff.edit', $member) }}"
                                        class="btn btn-sm btn-outline-emerald prod-btn-secondary"
                                        aria-label="Edit {{ $member->full_name }}"
                                    >
                                        <i class="bi bi-pencil me-1" aria-hidden="true"></i>
                                        Edit
                                    </a>

                                    <form
                                        method="POST"
                                        action="{{ route('staff.destroy', $member) }}"
                                        class="d-inline"
                                        onsubmit="return confirm('Archive {{ $member->full_name }}?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm prod-btn-archive"
                                            aria-label="Archive {{ $member->full_name }}"
                                        >
                                            <i class="bi bi-archive me-1" aria-hidden="true"></i>
                                            Archive
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                <div class="prod-empty-state">
                                    <span class="prod-empty-icon">
                                        <i class="bi bi-people" aria-hidden="true"></i>
                                    </span>

                                    <div class="prod-empty-title">
                                        No staff members yet
                                    </div>

                                    <div class="prod-empty-desc">
                                        Click <strong>Add Staff</strong> above to create a staff account.
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($staff->hasPages())
            <div class="prod-pagination-bar">
                {{ $staff->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</div>
@endsection