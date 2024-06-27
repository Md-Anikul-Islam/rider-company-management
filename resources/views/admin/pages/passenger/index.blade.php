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
                            <a href="#" class="text-muted text-hover-primary">Passenger</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="post d-flex flex-column-fluid mb-5" id="kt_post">
            <div id="kt_content_container" class="container-fluid">
                <div class="card card-flush">
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <div class="card-title">
                            <div id="kt_datatable_example_1_export" class="d-none"></div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="">

                            <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                <th>S/N</th>
                                <th>Profile</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                @foreach($passenger as $key=>$passengerData)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                    @if($passengerData->profile == null)
                                        N/A
                                    @else
                                        <img src="{{ asset($passengerData->profile) }}" alt="" style="height: 50px; width: 50px;" class="img-fluid" id="picture__preview">
                                    @endif

                                    </td>
                                    <td>{{$passengerData->name}}</td>
                                    <td>{{$passengerData->email? $passengerData->email:'N/A'}}</td>
                                    <td>{{$passengerData->phone}}</td>
                                    <td>
                                        @if( $passengerData->status == 'active')
                                            <span class="badge badge-success">Active</span>
                                        @elseif( $passengerData->status == 'inactive')
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection
