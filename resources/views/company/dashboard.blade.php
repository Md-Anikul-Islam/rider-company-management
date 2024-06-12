@extends('company.layout')
@section('company_content')
   <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center me-3 flex-wrap lh-1">
                <h1 class="d-flex align-items-center text-dark fw-bold my-1 fs-3">
                    Company</h1>
                <span class="h-20px border-gray-200 border-start mx-4"></span>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="#" class="text-muted text-hover-primary">Dashboard</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-fluid">
        <div class="row gy-5 g-xl-10">
            <div class="col-xl-4">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pt-7 mb-3">
                        <h3 class="card-title align-items-start flex-column" >
							<span class="card-label fw-bold text-gray-800">Our Fleet Tonnage</span>
                            <span class="text-gray-400 mt-1 fw-semibold fs-6">Total 1,247 vehicles</span>
                        </h3>

                        <div class="card-toolbar">
                            <a href="#" class="btn btn-sm btn-light" data-bs-toggle="tooltip" data-bs-dismiss="click" data-bs-custom-class="tooltip-inverse" title="Logistics App is coming soon">Review Fleet</a>
                        </div>
                    </div>
                    <div class="card-body pt-4">
                        <div class="d-flex flex-stack">
                            <div class="d-flex align-items-center me-5">
                                <div class="symbol symbol-40px me-4">
                                    <span class="symbol-label">
                                        <i class="ki-outline ki-ship text-gray-600 fs-1"></i>
                                    </span>
                                </div>
                                <div class="me-5">
                                    <a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6" >Ships</a>
                                    <span class="text-gray-400 fw-semibold fs-7 d-block text-start ps-0">234 Ships</span>
                                </div>
                            </div>

                            <div class="text-gray-400 fw-bold fs-7 text-end">
                                <span class="text-gray-800 fw-bold fs-6 d-block">2,345,500</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
