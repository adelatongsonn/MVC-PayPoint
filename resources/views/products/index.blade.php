@extends('layouts.pos')

@section('title', 'Product Management — PayPoint')
@section('page_title', 'Product Management')
@section('page_subtitle', 'Manage catalog items, pricing, and available stock')

@section('content')
<div class="prod-root">

    {{-- ── Page header ── --}}
    <div class="prod-page-header d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div>
            <div class="prod-section-label">MANAGEMENT</div>
            <h2 class="prod-page-title mb-0">Product Catalog</h2>
        </div>
        <a href="{{ route('products.create') }}" class="btn btn-gold prod-btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Add Product
        </a>
    </div>

    {{-- ── Catalog table panel ── --}}
    <div class="prod-panel">

        {{-- Panel header --}}
        <div class="prod-panel-header d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <span class="prod-icon-box">
                    <i class="bi bi-box-seam"></i>
                </span>
                <div>
                    <div class="prod-panel-title">All Products</div>
                    <div class="prod-panel-meta">
                        @if ($products->total() > 0)
                            Showing {{ $products->firstItem() }}–{{ $products->lastItem() }} of {{ $products->total() }} item(s)
                        @else
                            No products found
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div class="table-responsive">
            <table class="table prod-table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 80px; padding-left: 1.25rem;">Image</th>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th class="text-end" style="width: 220px; padding-right: 1.25rem;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr class="prod-row">
                            <td style="padding-left: 1.25rem;">
                                @if ($product->image)
                                    <img
                                        src="{{ asset('storage/' . $product->image) }}"
                                        alt="{{ $product->name }}"
                                        class="pos-thumb"
                                        onerror="this.outerHTML='<span class=\'pos-thumb-empty\' title=\'Image unavailable\'><i class=\'bi bi-image\'></i></span>'"
                                    >
                                @else
                                    <span class="pos-thumb-empty" title="No image">
                                        <i class="bi bi-box-seam"></i>
                                    </span>
                                @endif
                            </td>
                            <td>
                                <span>{{ $product->sku }}</span>
                            </td>
                            <td>
                                <div class="prod-name">{{ $product->name }}</div>
                            </td>
                            <td>
                                <div class="prod-price">₱{{ number_format($product->price, 2) }}</div>
                            </td>
                            <td>
                                @if ($product->stock_quantity === 0)
                                    <span class="prod-badge prod-badge-danger">
                                        <i class="bi bi-x-circle me-1"></i>Out of stock
                                    </span>
                                @elseif ($product->stock_quantity <= 5)
                                    <span class="prod-badge prod-badge-warning">
                                        <i class="bi bi-exclamation-circle me-1"></i>Low &mdash; {{ $product->stock_quantity }}
                                    </span>
                                @else
                                    <span class="prod-badge prod-badge-success">
                                        <i class="bi bi-check-circle me-1"></i>{{ $product->stock_quantity }} in stock
                                    </span>
                                @endif
                            </td>
                            <td class="text-end" style="padding-right: 1.25rem;">
                                <div class="d-inline-flex gap-2">
                                    <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-outline-emerald prod-btn-secondary">
                                        <i class="bi bi-pencil me-1"></i> Edit
                                    </a>
                                    <form
                                        method="POST"
                                        action="{{ route('products.destroy', $product) }}"
                                        class="d-inline"
                                        onsubmit="return confirm('Delete {{ addslashes($product->name) }}? This will hide it from the catalog.')"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm prod-btn-archive">
                                            <i class="bi bi-trash me-1"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="prod-empty-state">
                                    <span class="prod-empty-icon">
                                        <i class="bi bi-box-seam"></i>
                                    </span>
                                    <div class="prod-empty-title">No products yet</div>
                                    <div class="prod-empty-desc">
                                        Click <strong>Add Product</strong> above to add your first catalog item.
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($products->hasPages())
            <div class="prod-pagination-bar">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        @endif

    </div>{{-- /.prod-panel --}}

</div>{{-- /.prod-root --}}
@endsection
