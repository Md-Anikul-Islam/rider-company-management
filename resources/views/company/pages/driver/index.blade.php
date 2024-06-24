@extends('company.layout')
@section('company_content')
<div class="toolbar" id="kt_toolbar">
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center me-3 flex-wrap lh-1">
            <h1 class="d-flex align-items-center text-dark fw-bold my-1 fs-3"> Company</h1>
            <span class="h-20px border-gray-200 border-start mx-4"></span>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-1">
                <li class="breadcrumb-item text-muted">
                    <a href="#" class="text-muted text-hover-primary">Driver</a>
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
                    @foreach($drivers as $key=>$driverData)
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
                                @if( $driverData->status == 1)
                                    <span class="badge badge-success">Active</span>
                                @elseif( $driverData->status == 0)
                                    <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                            {{-- <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalFormDataEdit{{$driverData->id}}">Edit</button> --}}
                                <a href="{{route('company.driver.details.show',$driverData->id)}}" class="btn btn-info btn-sm">Details</a>
                                <a href="{{route('company.driver.delete',$driverData->id)}}" class="btn btn-danger btn-sm delete-division" data-bs-toggle="modal" data-bs-target="#deleteModal{{$driverData->id}}" data-category-id="{{$driverData->id}}">Delete</a>
                            </td>
                        </tr>
                        <!-- Edit Modal for Current Relation -->
                        <div class="modal fade" id="modalFormDataEdit{{$driverData->id}}" aria-labelledby="editModalLabel{{$driverData->id}}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered mw-1000px">
                                <div class="modal-content rounded">
                                    <div class="modal-header pb-0 border-0 justify-content-end">
                                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                            <i class="ki-outline ki-cross fs-1"></i>
                                        </div>
                                    </div>
                                    <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                                        <form action="{{route('company.driver.update',$driverData->id)}}" method="post" class="form" enctype="multipart/form-data">
                                        @csrf @method('PUT')
                                        <div class="mb-13 text-center">
                                                <h1 id="editModalLabel{{$driverData->id}}" class="mb-3">Edit Driver</h1>
                                            </div>
                                            <div class="row g-9 mb-8">
                                                <div class="col-md-6 fv-row">
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Car</label>
                                                    <select name="car_id" class="form-select form-select-solid" required>
                                                        @foreach($car as $carData)
                                                            <option value="{{$carData->id}}" {{$driverData->car_id == $carData->id ? 'selected' : ''}}>{{$carData->car_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                               <div class="col-md-6 fv-row">
                                                   <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Name</label>
                                                   <input type="text" name="name" class="form-control form-control-solid" value="{{$driverData->name}}" placeholder="Enter Driver Name" />
                                               </div>
                                            </div>

                                             <div class="row g-9 mb-8">
                                                <div class="col-md-6 fv-row">
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Email</label>
                                                    <input type="email" name="email" class="form-control form-control-solid" value="{{$driverData->email}}" placeholder="Enter Driver Email" />
                                                </div>
                                                <div class="col-md-6 fv-row">
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Phone</label>
                                                    <input type="text" name="phone" class="form-control form-control-solid" value="{{$driverData->phone}}" placeholder="Enter Driver Phone" />
                                                </div>
                                             </div>


                                              <div class="row g-9 mb-8">
                                                 <div class="col-md-6 fv-row">
                                                     <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Gender</label>
                                                     <select name="gender" class="form-select form-select-solid" required>
                                                        <option value="Male" {{$driverData->gender == 'Male' ? 'selected' : ''}}>Male</option>
                                                        <option value="Female" {{$driverData->gender == 'Female' ? 'selected' : ''}}>Female</option>
                                                     </select>
                                                 </div>
                                                <div class="col-md-6 fv-row">
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Birth Date</label>
                                                    <input type="date" name="dob" class="form-control form-control-solid" value="{{$driverData->dob}}" placeholder="Enter Birth Date" />
                                                </div>
                                              </div>

                                            <div class="row g-9 mb-8">
                                                <div class="col-md-6 fv-row">
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Driving Licence Font Side</label>
                                                    <input type="file" name="driving_licence_font_image" class="form-control form-control-solid" value="{{$driverData->driving_licence_font_image}}" placeholder="Enter Driving Licence" />
                                                </div>
                                                <div class="col-md-6 fv-row">
                                                   <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Driving Licence Back Side</label>
                                                   <input type="file" name="driving_licence_back_image" class="form-control form-control-solid" value="{{$driverData->driving_licence_back_image}}" placeholder="Enter Driving Licence" />
                                                </div>
                                            </div>


                                            <div class="row g-9 mb-8">
                                                <div class="col-md-6 fv-row">
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">RTA Card Font Side</label>
                                                    <input type="file" name="rta_card_font_image" class="form-control form-control-solid" value="{{$driverData->rta_card_font_image}}" placeholder="Enter RTA Card" />
                                                </div>
                                                <div class="col-md-6 fv-row">
                                                   <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">RTA Card Back Side</label>
                                                   <input type="file" name="rta_card_back_image" class="form-control form-control-solid" value="{{$driverData->rta_card_back_image}}" placeholder="Enter RTA Card" />
                                                </div>
                                            </div>

                                            <div class="row g-9 mb-8">
                                                <div class="col-md-6 fv-row">
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Address</label>
                                                    <input type="text" name="address" class="form-control form-control-solid" value="{{$driverData->address}}" placeholder="Enter Address" />
                                                </div>
                                                <div class="col-md-6 fv-row">
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Password</label>
                                                    <input type="password" name="password" class="form-control form-control-solid" value="{{$driverData->password}}" placeholder="Enter Password" />
                                                </div>
                                            </div>
                                            <div class="row g-9 mb-8">
                                                <div class="col-md-12 fv-row">
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Status</label>
                                                    <select name="status" class="form-select form-select-solid">
                                                        <option value="active" {{$driverData->status == 1 ? 'selected' : ''}}>Active</option>
                                                        <option value="inactive" {{$driverData->status == 0 ? 'selected' : ''}}>Inactive</option>
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
                        <div class="modal fade" id="deleteModal{{$driverData->id}}" tabindex="-1" aria-labelledby="deleteModalLabel{{$driverData->id}}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{$driverData->id}}">Delete Driver</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete Driver?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <a href="{{route('company.driver.delete',$driverData->id)}}" class="btn btn-danger">Delete</a>
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
                <form action="{{route('company.driver.store')}}" method="post" class="form" enctype="multipart/form-data">
                 @csrf
                    <div class="mb-13 text-center">
                        <h1 class="mb-3">Add Driver</h1>
                    </div>
                     <div class="mb-13 text-center">
                        <div class="row g-9 mb-8">
                            <div class="col-md-6 fv-row">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Car</label>
                                <select name="car_id" class="form-select form-select-solid" required>
                                 @foreach($car as $carData)
                                     <option value="{{$carData->id}}">{{$carData->car_name}}</option>
                                 @endforeach
                                </select>
                            </div>
                           <div class="col-md-6 fv-row">
                               <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Name</label>
                               <input type="text" name="name" class="form-control form-control-solid" placeholder="Enter Driver Name" />
                           </div>
                        </div>
                        <div class="row g-9 mb-8">
                            <div class="col-md-6 fv-row">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Email</label>
                                <input type="email" name="email" class="form-control form-control-solid"  placeholder="Enter Driver Email" />
                            </div>
                            <div class="col-md-6 fv-row">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Phone</label>
                                <input type="text" name="phone" class="form-control form-control-solid"  placeholder="Enter Driver Phone" />
                            </div>
                         </div>
                        <div class="row g-9 mb-8">
                             <div class="col-md-6 fv-row">
                                 <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Gender</label>
                                 <select name="gender" class="form-select form-select-solid" required>
                                     <option value="">Select Gender</option>
                                     <option value="Male">Male</option>
                                     <option value="Female">Female</option>
                                 </select>
                             </div>
                            <div class="col-md-6 fv-row">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Birth Date</label>
                                <input type="date" name="dob" class="form-control form-control-solid" placeholder="Enter Birth Date" />
                            </div>
                          </div>
                        <div class="row g-9 mb-8">
                            <div class="col-md-6 fv-row">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Driving Licence Font Side</label>
                                <input type="file" name="driving_licence_font_image" class="form-control form-control-solid" placeholder="Enter Driving Licence" />
                            </div>
                            <div class="col-md-6 fv-row">
                               <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Driving Licence Back Side</label>
                               <input type="file" name="driving_licence_back_image" class="form-control form-control-solid"  placeholder="Enter Driving Licence" />
                            </div>
                        </div>


                         <div class="row g-9 mb-8">
                            <div class="col-md-6 fv-row">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">RTA Card Font Side</label>
                                <input type="file" name="rta_card_font_image" class="form-control form-control-solid" placeholder="Enter RTA Card" />
                            </div>
                            <div class="col-md-6 fv-row">
                               <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">RTA Card Back Side</label>
                               <input type="file" name="rta_card_back_image" class="form-control form-control-solid" placeholder="Enter RTA Card" />
                            </div>
                        </div>



                        <div class="row g-9 mb-8">
                            <div class="col-md-6 fv-row">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Address</label>
                                <input type="text" name="address" class="form-control form-control-solid"  placeholder="Enter Address" />
                            </div>
                            <div class="col-md-6 fv-row">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Password</label>
                                <input type="password" name="password" class="form-control form-control-solid"  placeholder="Enter Password" />
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
                            </button>
                        </div>
                     </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection