@extends('admin.layout')
@section('admin_content')
<div class="toolbar" id="kt_toolbar">
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center me-3 flex-wrap lh-1">
            <h1 class="d-flex align-items-center text-dark fw-bold my-1 fs-3">
                Admin</h1>
            <span class="h-20px border-gray-200 border-start mx-4"></span>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-1">
                <li class="breadcrumb-item text-muted">
                    <a href="#" class="text-muted text-hover-primary">Change Password</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="post d-flex flex-column-fluid mb-5" id="kt_post">
    <div id="kt_content_container" class="container-fluid">
        <div class="card card-flush">
            <div class="card-body">
                <form action="{{ route('admin.password.update') }}" method="post" class="form">
                    @csrf
                    <div class="mb-13 text-center">
                        <h1 class="mb-3">Change Password</h1>
                    </div>
                    <div class="row g-9 mb-8">
                        <div class="col-md-12 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Old Password</label>
                            <input type="password" name="old_password" class="form-control form-control-solid" placeholder="Enter Old Password" />
                            @error('old_password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-9 mb-8">
                        <div class="col-md-12 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">New Password</label>
                            <input type="password" name="password" class="form-control form-control-solid" placeholder="Enter New Password" />
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-9 mb-8">
                        <div class="col-md-12 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Confirm New Password</label>
                            <input type="password" name="password_confirmation" class="form-control form-control-solid" placeholder="Confirm New Password" />
                            @error('password_confirmation')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Update</span>
                        </button>
                    </div>

                    @if (session('success'))
                        <div class="text-success mt-3">{{ session('success') }}</div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
