@extends('admin.layout')
@section('admin_content')
<div class="toolbar" id="kt_toolbar">
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center me-3 flex-wrap lh-1">
            <h1 class="d-flex align-items-center text-dark fw-bold my-1 fs-3"> Admin</h1>
            <span class="h-20px border-gray-200 border-start mx-4"></span>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-1">
                <li class="breadcrumb-item text-muted">
                    <a href="#" class="text-muted text-hover-primary">Company Under Driver List</a>
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
                <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalFormDataSave" class="btn btn-primary">Add New</a>
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
                            <th>Gender</th>
                            <th>RTA Card</th>
                            <th>Driving License</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                    @foreach($driver as $key=>$driverData)
                    <tr>
                            <td>{{$key+1}}</td>
                            <td>
                             @if(($driverData->profile) == null)
                               N/A
                             @else
                               <img src="{{ asset($driverData->profile) }}" alt="" style="height: 50px; width: 50px;" class="img-fluid" id="picture__preview">
                             @endif
                            </td>
                            <td>{{$driverData->name}}</td>
                            <td>{{$driverData->email}}</td>
                            <td>{{$driverData->phone}}</td>
                            <td>{{$driverData->gender}}</td>
                            <td>
                              <img src="{{ asset($driverData->rta_card_font_image) }}" alt="" style="height: 50px; width: 50px;" class="img-fluid" id="picture__preview">
                            </td>
                            <td>
                              <img src="{{ asset($driverData->driving_licence_font_image) }}" alt="" style="height: 50px; width: 50px;" class="img-fluid" id="picture__preview">
                            </td>
                            <td>
                                @if( $driverData->status == 'active')
                                    <span class="badge badge-success">Active</span>
                                @elseif( $driverData->status == 'inactive')
                                    <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>



                             <td>
                               <div class="btn-group dropstart action_button_wrapper">
                                   <button type="button" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                       <i class="fa-solid fa-angles-down"></i>
                                   </button>
                                   <ul class="dropdown-menu action_dropdown_menu">

                                       <li>
                                           <a class="dropdown-item" href="{{route('admin.company.under.driver.details',$driverData->id)}}"><i class="fa-solid fa-eye"></i> Details</a>
                                       </li>

                                   </ul>
                               </div>
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