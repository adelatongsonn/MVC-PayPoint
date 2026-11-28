@extends('layouts.pos')

@section('title', 'Add Customer — PayPoint')
@section('page_title', 'Add Customer')
@section('page_subtitle', 'Add a new customer to your directory')

@section('content')
<div class="prod-form-root">
    <div class="mb-4">
        <a href="{{ route('customers.index') }}" class="prod-back-link">
            <i class="bi bi-arrow-left" aria-hidden="true"></i>
            <span>Back to Customer Directory</span>
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">
            <div class="prod-form-panel">
                <div class="prod-form-panel-header">
                    <div class="d-flex align-items-center gap-3">
                        <span class="prod-form-icon-box">
                            <i class="bi bi-person-plus" aria-hidden="true"></i>
                        </span>
                        <div>
                            <div class="prod-form-panel-title">New Customer</div>
                            <div class="prod-form-panel-meta">Fill in the customer's name and contact details</div>
                        </div>
                    </div>
                </div>

                <div class="prod-form-body">
                    <form method="POST" action="{{ route('customers.store') }}">
                        @csrf
                        @include('customers.form')

                        <div class="prod-form-footer flex-wrap">
                            <a href="{{ route('customers.index') }}" class="btn prod-cancel-btn">Cancel</a>
                            <button type="submit" class="btn btn-gold prod-submit-btn">
                                <i class="bi bi-check-lg me-1" aria-hidden="true"></i> Save Customer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
