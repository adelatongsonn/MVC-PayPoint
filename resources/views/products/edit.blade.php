@extends('layouts.pos')

@section('title', 'Edit Product — PayPoint')
@section('page_title', 'Edit Product')
@section('page_subtitle', 'Update product pricing, stock, or image')

@section('content')
<div class="prod-form-root">

    {{-- Back navigation --}}
    <div class="mb-4">
        <a href="{{ route('products.index') }}" class="prod-back-link">
            <i class="bi bi-arrow-left"></i>
            <span>Back to Product Catalog</span>
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">

            {{-- Form panel --}}
            <div class="prod-form-panel">

                {{-- Panel header --}}
                <div class="prod-form-panel-header">
                    <div class="d-flex align-items-center gap-3">
                        <span class="prod-form-icon-box">
                            <i class="bi bi-pencil-square"></i>
                        </span>
                        <div>
                            <div class="prod-form-panel-title">Edit Product</div>
                            <div class="prod-form-panel-meta">Editing <strong style="color: var(--tamaraw-slate);">{{ $product->name }}</strong></div>
                        </div>
                    </div>
                </div>

                {{-- Form body --}}
                <div class="prod-form-body">
                    <form
                        method="POST"
                        action="{{ route('products.update', $product) }}"
                        enctype="multipart/form-data"
                    >
                        @csrf
                        @method('PUT')

                        @include('products.form')

                        <div class="prod-form-footer">
                            <a href="{{ route('products.index') }}" class="btn prod-cancel-btn">Cancel</a>
                            <button type="submit" class="btn btn-gold prod-submit-btn">
                                <i class="bi bi-check-lg me-1"></i> Update Product
                            </button>
                        </div>
                    </form>
                </div>

            </div>{{-- /.prod-form-panel --}}

        </div>
    </div>

</div>
@endsection
