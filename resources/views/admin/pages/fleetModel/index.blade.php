@extends('admin.layout')
@section('admin_content')
<div class="toolbar" id="kt_toolbar">
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center me-3 flex-wrap lh-1">
            <h1 class="d-flex align-items-center text-dark fw-bold my-1 fs-3"> Admin</h1>
            <span class="h-20px border-gray-200 border-start mx-4"></span>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-1">
                <li class="breadcrumb-item text-muted">
                    <a href="#" class="text-muted text-hover-primary">Fleet Model</a>
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
                            <th>Car Maker Company Name</th>
                            <th>Car Model</th>
                            <th>Car Base Fare</th>
                            <th>Car Passenger Capacity</th>
                            <th>Car Bag Capacity</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                    @foreach($fleetModel as $key=>$fleetModelData)
                    <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$fleetModelData->fleetMake->car_make_name}}</td>
                            <td>{{$fleetModelData->car_model_name}}</td>
                            <td>{{$fleetModelData->car_base_fare}}</td>
                            <td>{{$fleetModelData->car_passenger_capacity}}</td>
                            <td>{{$fleetModelData->car_bag_capacity}}</td>
                            <td>
                                @if( $fleetModelData->status == 'active')
                                    <span class="badge badge-success">Active</span>
                                @elseif( $fleetModelData->status == 'inactive')
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
                                           <a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#modalFormDataEdit{{$fleetModelData->id}}"><i class="fa-solid fa-edit"></i> Edit</a>
                                       </li>
                                       <li>
                                          <a class="dropdown-item" href="{{route('admin.fleet.model.delete',$fleetModelData->id)}}"  data-bs-toggle="modal" data-bs-target="#deleteModal{{$fleetModelData->id}}" data-category-id="{{$fleetModelData->id}}"><i class="fa-solid fa-trash"></i> Delete</a>
                                       </li>
                                   </ul>
                               </div>
                            </td>
                        </tr>
                        <!-- Edit Modal for Current Relation -->
                        <div class="modal fade" id="modalFormDataEdit{{$fleetModelData->id}}" aria-labelledby="editModalLabel{{$fleetModelData->id}}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered mw-1000px">
                                <div class="modal-content rounded">
                                    <div class="modal-header pb-0 border-0 justify-content-end">
                                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                            <i class="ki-outline ki-cross fs-1"></i>
                                        </div>
                                    </div>
                                    <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                                        <form action="{{route('admin.fleet.model.update',$fleetModelData->id)}}" method="post" class="form" enctype="multipart/form-data">
                                        @csrf @method('PUT')
                                        <div class="mb-13 text-center">
                                                <h1 id="editModalLabel{{$fleetModelData->id}}" class="mb-3">Edit</h1>
                                            </div>
                                                <div class="row g-9 mb-8">
                                                    <div class="col-md-6 fv-row">
                                                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Car Type</label>
                                                        <select name="fleet_make_id" class="form-select form-select-solid" required>
                                                            @foreach($carMakeTypes as $carMakeTypeData)
                                                                <option value="{{$carMakeTypeData->id}}" {{$fleetModelData->fleet_make_id == $carMakeTypeData->id ? 'selected' : ''}}>{{$carMakeTypeData->car_make_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 fv-row">
                                                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Car Model</label>
                                                        <input type="text" name="car_model_name" class="form-control form-control-solid" value="{{$fleetModelData->car_model_name}}" placeholder="Enter Car Model" />
                                                    </div>
                                                </div>


                                              <div class="row g-9 mb-8">
                                                 <div class="col-md-6 fv-row">
                                                     <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Car Base Fare</label>
                                                     <input type="text" name="car_base_fare" class="form-control form-control-solid" value="{{$fleetModelData->car_base_fare}}" placeholder="Enter Car Base Fare" />
                                                 </div>
                                                <div class="col-md-6 fv-row">
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Car Passenger Capacity</label>
                                                    <input type="text" name="car_passenger_capacity" class="form-control form-control-solid" value="{{$fleetModelData->car_passenger_capacity}}" placeholder="Enter Car Passenger Capacity" />
                                                </div>

                                                <div class="col-md-6 fv-row">
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Car Bag Capacity</label>
                                                    <input type="text" name="car_bag_capacity" class="form-control form-control-solid" value="{{$fleetModelData->car_bag_capacity}}" placeholder="Enter Car Bag Capacity" />
                                                </div>
                                                <div class="col-md-6 fv-row">
                                                   <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Status</label>
                                                   <select name="status" class="form-select form-select-solid">
                                                       <option value="active" {{$fleetModelData->status == 'active' ? 'selected' : ''}}>Active</option>
                                                       <option value="inactive" {{$fleetModelData->status == 'inactive' ? 'selected' : ''}}>Inactive</option>
                                                   </select>
                                                </div>


                                              </div>

                                            <div class="text-end">
                                                <button type="submit" class="btn btn-primary">
                                                    <span class="indicator-label">Update</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="deleteModal{{$fleetModelData->id}}" tabindex="-1" aria-labelledby="deleteModalLabel{{$fleetModelData->id}}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{$fleetModelData->id}}">Delete</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <a href="{{route('admin.fleet.model.delete',$fleetModelData->id)}}" class="btn btn-danger">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
{{--Relation Add Modal--}}
<div class="modal fade" id="modalFormDataSave" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-1000px">
        <div class="modal-content rounded">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
            </div>
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                <form action="{{route('admin.fleet.model.store')}}" method="post" class="form" enctype="multipart/form-data"> @csrf <div class="mb-13 text-center">
                        <h1 class="mb-3">Add Company</h1>
                    </div>
                    <div class="row g-9 mb-8">
                        <div class="col-md-6 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Car Type</label>
                            <select name="fleet_make_id" class="form-select form-select-solid" required>
                                @foreach($carMakeTypes as $carMakeTypesData)
                                    <option value="{{$carMakeTypesData->id}}">{{$carMakeTypesData->car_make_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 fv-row">
                           <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Car Model</label>
                           <input type="text" name="car_model_name" class="form-control form-control-solid" placeholder="Enter Car Model" />
                        </div>
                    </div>

                     <div class="row g-9 mb-8">
                         <div class="col-md-6 fv-row">
                             <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Car Base Fare</label>
                             <input type="text" name="car_base_fare" class="form-control form-control-solid"  placeholder="Enter Car Base Fare" />
                         </div>
                        <div class="col-md-6 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Car Passenger Capacity</label>
                            <input type="text" name="car_passenger_capacity" class="form-control form-control-solid"  placeholder="Enter Car Passenger Capacity" />
                        </div>

                        <div class="col-md-6 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Car Bag Capacity</label>
                            <input type="text" name="car_bag_capacity" class="form-control form-control-solid" placeholder="Enter Car Bag Capacity" />
                        </div>
                      </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Submit</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection