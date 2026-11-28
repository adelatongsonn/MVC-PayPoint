@extends('layouts.pos')

@section('title', 'Customer Management — PayPoint')
@section('page_title', 'Customer Management')
@section('page_subtitle', 'Manage customer details and contact information')

@section('content')
<div class="prod-root">
    <div class="prod-page-header d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div>
            <div class="prod-section-label">MANAGEMENT</div>
            <h2 class="prod-page-title mb-0">Customer Directory</h2>
        </div>
        <a href="{{ route('customers.create') }}" class="btn btn-gold prod-btn-primary">
            <i class="bi bi-person-plus me-1" aria-hidden="true"></i> Add Customer
        </a>
    </div>

    <div class="prod-panel">
        <div class="prod-panel-header d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <span class="prod-icon-box">
                    <i class="bi bi-people" aria-hidden="true"></i>
                </span>
                <div>
                    <div class="prod-panel-title">All Customers</div>
                    <div class="prod-panel-meta">
                        @if ($customers->total() > 0)
                            Showing {{ $customers->firstItem() }}–{{ $customers->lastItem() }} of {{ $customers->total() }} customer(s)
                        @else
                            No customers found
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table prod-table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th scope="col" class="ps-4">Customer ID</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col" class="text-end pe-4" style="width: 220px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($customers as $customer)
                        <tr class="prod-row">
                            <td class="ps-4 small text-nowrap">{{ $customer->customer_code }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="prod-icon-box">
                                        <i class="bi bi-person" aria-hidden="true"></i>
                                    </span>
                                    <span class="prod-name text-break">{{ $customer->full_name }}</span>
                                </div>
                            </td>
                            <td class="small text-break">{{ $customer->email }}</td>
                            <td class="small text-nowrap">
                                @if ($customer->phone)
                                    {{ $customer->phone }}
                                @else
                                    <span class="text-muted">Not provided</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-inline-flex gap-2">
                                    <a href="{{ route('customers.edit', $customer) }}" class="btn btn-sm btn-outline-emerald prod-btn-secondary" aria-label="Edit {{ $customer->full_name }}">
                                        <i class="bi bi-pencil me-1" aria-hidden="true"></i> Edit
                                    </a>
                                    <form
                                        method="POST"
                                        action="{{ route('customers.destroy', $customer) }}"
                                        class="d-inline"
                                        data-customer-name="{{ $customer->full_name }}"
                                        onsubmit="return confirm('Delete ' + this.dataset.customerName + '? This cannot be undone.')"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm prod-btn-archive" aria-label="Delete {{ $customer->full_name }}">
                                            <i class="bi bi-trash me-1" aria-hidden="true"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="prod-empty-state">
                                    <span class="prod-empty-icon">
                                        <i class="bi bi-people" aria-hidden="true"></i>
                                    </span>
                                    <div class="prod-empty-title">No customers yet</div>
                                    <div class="prod-empty-desc">
                                        Click <strong>Add Customer</strong> above to add your first customer.
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($customers->hasPages())
            <div class="prod-pagination-bar">
                {{ $customers->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</div>
@endsection
