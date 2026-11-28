@extends('layouts.pos')

@section('title', 'Edit Staff — PayPoint')
@section('page_title', 'Edit Staff')
@section('page_subtitle', 'Update staff account information')

@section('content')
<div class="prod-form-root">
    <div class="mb-4">
        <a href="{{ route('staff.index') }}" class="prod-back-link">
            <i class="bi bi-arrow-left"></i>
            <span>Back to Staff Directory</span>
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">
            <div class="prod-form-panel">
                <div class="prod-form-panel-header">
                    <div class="d-flex align-items-center gap-3">
                        <span class="prod-form-icon-box">
                            <i class="bi bi-person-gear"></i>
                        </span>

                        <div>
                            <div class="prod-form-panel-title">
                                Edit Staff Account
                            </div>

                            <div class="prod-form-panel-meta">
                                Update the staff member's account details
                            </div>
                        </div>
                    </div>
                </div>

                <div class="prod-form-body">
                    <form
                        method="POST"
                        action="{{ route('staff.update', $staff) }}"
                        enctype="multipart/form-data"
                    >
                        @csrf
                        @method('PUT')

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
                                <i class="bi bi-check-lg me-1"></i>
                                Update Staff
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection