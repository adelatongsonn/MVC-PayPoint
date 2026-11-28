@extends('layouts.pos')

@section('title', 'Add Product — PayPoint')
@section('page_title', 'Add Product')
@section('page_subtitle', 'Create a new item in the product catalog')

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
                            <i class="bi bi-plus-circle"></i>
                        </span>
                        <div>
                            <div class="prod-form-panel-title">New Product</div>
                            <div class="prod-form-panel-meta">Fill in the details below to add a new catalog item</div>
                        </div>
                    </div>
                </div>

                {{-- Form body --}}
                <div class="prod-form-body">
                    <form
                        method="POST"
                        action="{{ route('products.store') }}"
                        enctype="multipart/form-data"
                    >
                        @csrf

                        @include('products.form')

                        <div class="prod-form-footer">
                            <a href="{{ route('products.index') }}" class="btn prod-cancel-btn">Cancel</a>
                            <button type="submit" class="btn btn-gold prod-submit-btn">
                                <i class="bi bi-check-lg me-1"></i> Save Product
                            </button>
                        </div>
                    </form>
                </div>

            </div>{{-- /.prod-form-panel --}}

        </div>
    </div>

</div>
@endsection
