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
                        <a href="#" class="text-muted text-hover-primary">Dashboard</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="post d-flex flex-column-fluid mb-5" id="kt_post">
        <div id="kt_content_container" class="container-fluid">
            <div class="row g-5 gx-xl-10 mb-5 mb-xl-10" >


                <div class="col-xl-3">
                    <div class="card card-flush h-xl-100 company_card" style="background-color: black">
                        <div class="card-header pt-7 mb-3">
                            <h3 class="card-title align-items-start flex-column" >
                                <span class="card-label fw-bold text-gray-800">Total Company</span>

                            </h3>
                        </div>
                        <div class="card-body pt-0">
                            <div class="d-flex flex-stack">
                                <div class="d-flex align-items-center me-5">
                                    <div class="me-5">
                                        <a href="#">{{$totalCompanies}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-xl-3">
                    <div class="card card-flush h-xl-100 company_card" style="background-color: black">
                        <div class="card-header pt-7 mb-3">
                            <h3 class="card-title align-items-start flex-column" >
                                <span class="card-label fw-bold text-gray-800">Total Passenger</span>

                            </h3>
                        </div>
                        <div class="card-body pt-0">
                            <div class="d-flex flex-stack">
                                <div class="d-flex align-items-center me-5">
                                    <div class="me-5">
                                        <a href="#">{{$totalPassengers}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-xl-3">
                    <div class="card card-flush h-xl-100 company_card" style="background-color: black">
                        <div class="card-header pt-7 mb-3">
                            <h3 class="card-title align-items-start flex-column" >
                                <span class="card-label fw-bold text-gray-800">Total Driver</span>

                            </h3>
                        </div>
                        <div class="card-body pt-0">
                            <div class="d-flex flex-stack">
                                <div class="d-flex align-items-center me-5">
                                    <div class="me-5">
                                        <a href="#">{{$totalDrivers}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-3">
                    <div class="card card-flush h-xl-100 company_card" style="background-color: black">
                        <div class="card-header pt-7 mb-3">
                            <h3 class="card-title align-items-start flex-column" >
                                <span class="card-label fw-bold text-gray-800">Total Agent</span>

                            </h3>
                        </div>
                        <div class="card-body pt-0">
                            <div class="d-flex flex-stack">
                                <div class="d-flex align-items-center me-5">
                                    <div class="me-5">
                                        <a href="#">{{$totalAgents}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




            </div>
        </div>
    </div>
@endsection
