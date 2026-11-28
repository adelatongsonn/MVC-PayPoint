@extends('layouts.pos')

@section('title', 'Sales History — PayPoint')
@section('page_title', 'Sales History')
@section('page_subtitle', 'Review recorded sales transactions')

@section('content')
<div class="prod-root">
    <div class="prod-page-header d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div>
            <div class="prod-section-label">TRANSACTIONS</div>
            <h2 class="prod-page-title mb-0">Sales History</h2>
        </div>

        <a href="{{ route('sales.create') }}" class="btn btn-gold prod-btn-primary">
            <i class="bi bi-cart-plus me-1" aria-hidden="true"></i>
            Record New Sale
        </a>
    </div>

    <div class="prod-panel">
        <div class="prod-panel-header d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <span class="prod-icon-box">
                    <i class="bi bi-receipt" aria-hidden="true"></i>
                </span>

                <div>
                    <div class="prod-panel-title">All Sales Transactions</div>

                    <div class="prod-panel-meta">
                        @if ($sales->total() > 0)
                            Showing {{ $sales->firstItem() }}–{{ $sales->lastItem() }}
                            of {{ $sales->total() }} sale(s)
                        @else
                            No sales transactions found
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table prod-table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th scope="col" class="ps-4">Product</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Staff</th>
                        <th scope="col" class="text-center">Quantity</th>
                        <th scope="col" class="text-end">Total Price</th>
                        <th scope="col" class="pe-4">Date</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($sales as $sale)
                        <tr class="prod-row">
                            <td class="ps-4">
                                <span class="prod-name">
                                    {{ $sale->product?->name ?? 'Archived Product' }}
                                </span>
                            </td>

                            <td>
                                {{ $sale->customer?->full_name ?? 'Walk-in Customer' }}
                            </td>

                            <td>
                                {{ $sale->staff?->full_name ?? 'Archived Staff' }}
                            </td>

                            <td class="text-center">
                                {{ $sale->quantity }}
                            </td>

                            <td class="text-end">
                                <strong>
                                    {{ number_format($sale->total_price, 2) }}
                                </strong>
                            </td>

                            <td class="pe-4 text-nowrap">
                                {{ $sale->created_at->format('M d, Y h:i A') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="prod-empty-state">
                                    <span class="prod-empty-icon">
                                        <i class="bi bi-receipt" aria-hidden="true"></i>
                                    </span>

                                    <div class="prod-empty-title">
                                        No sales transactions yet
                                    </div>

                                    <div class="prod-empty-desc">
                                        Click <strong>Record New Sale</strong> above to create a transaction.
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($sales->hasPages())
            <div class="prod-pagination-bar">
                {{ $sales->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</div>
@endsection