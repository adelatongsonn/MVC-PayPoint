@extends('layouts.pos')

@section('title', 'Add Staff — PayPoint')
@section('page_title', 'Add Staff')
@section('page_subtitle', 'Create a new staff account')

@section('content')
<div class="prod-form-root">
    <div class="mb-4">
        <a href="{{ route('staff.index') }}" class="prod-back-link">
            <i class="bi bi-arrow-left" aria-hidden="true"></i>
            <span>Back to Staff Directory</span>
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
                            <div class="prod-form-panel-title">
                                New Staff Account
                            </div>

                            <div class="prod-form-panel-meta">
                                Fill in the staff member's account details
                            </div>
                        </div>
                    </div>
                </div>

                <div class="prod-form-body">
                    <form
                        method="POST"
                        action="{{ route('staff.store') }}"
                        enctype="multipart/form-data"
                    >
                        @csrf

                        @include('staff.form')

                        <div class="prod-form-footer flex-wrap">
                            <a
                                href="{{ route('staff.index') }}"
                                class="btn prod-cancel-btn"
                            >
                                Cancel
                            </a>

                            <button
                                type="submit"
                                class="btn btn-gold prod-submit-btn"
                            >
                                <i class="bi bi-check-lg me-1" aria-hidden="true"></i>
                                Save Staff
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection