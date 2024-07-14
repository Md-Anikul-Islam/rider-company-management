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
                        <a href="#" class="text-muted text-hover-primary">Company</a>
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
                                <th>Company Logo</th>
                                <th>Company Name</th>
                                <th>Company Email</th>
                                <th>Company Phone</th>
                                <th>Company Address</th>
                                <th>Company Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                @foreach($companies as $key=>$companiesData)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                     <img src="{{ asset($companiesData->logo) }}" alt="" style="height: 50px; width: 50px;" class="img-fluid" id="picture__preview">
                                    </td>
                                    <td>{{$companiesData->name}}</td>
                                    <td>{{$companiesData->email}}</td>
                                    <td>{{$companiesData->phone}}</td>
                                    <td>{{$companiesData->address}}</td>
                                    <td>
                                        @if( $companiesData->status == 'active')
                                            <span class="badge badge-success">Active</span>
                                        @elseif( $companiesData->status == 'inactive')
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
                                                  <a class="dropdown-item" href="{{route('admin.company.details.show',$companiesData->id)}}"><i class="fa-solid fa-eye"></i> Details</a>
                                               </li>
                                               <li>
                                                   <a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#modalFormDataEdit{{$companiesData->id}}"><i class="fa-solid fa-edit"></i> Edit</a>
                                               </li>
                                               <li>
                                                   <a class="dropdown-item" href="{{route('admin.company.under.driver.list',$companiesData->id)}}"><i class="fa-solid fa-eye"></i> Driver</a>
                                               </li>
                                               <li>
                                                  <a class="dropdown-item" href="{{route('admin.company.delete',$companiesData->id)}}"  data-bs-toggle="modal" data-bs-target="#deleteModal{{$companiesData->id}}" data-category-id="{{$companiesData->id}}"><i class="fa-solid fa-trash"></i> Delete</a>
                                               </li>
                                           </ul>
                                       </div>
                                     </td>
                                </tr>

                                <!-- Edit Modal for Current Relation -->
                                <div class="modal fade" id="modalFormDataEdit{{$companiesData->id}}" aria-labelledby="editModalLabel{{$companiesData->id}}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered mw-650px">
                                        <div class="modal-content rounded">
                                            <div class="modal-header pb-0 border-0 justify-content-end">
                                                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                                    <i class="ki-outline ki-cross fs-1"></i>
                                                </div>
                                            </div>
                                            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                                                <form action="{{route('admin.company.update',$companiesData->id)}}" method="post" class="form" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-13 text-center">
                                                        <h1 id="editModalLabel{{$companiesData->id}}" class="mb-3">Edit Company</h1>
                                                    </div>
                                                    <div class="row g-9 mb-8">
                                                           <div class="col-md-12 fv-row">
                                                               <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Company Name</label>
                                                               <input type="text" name="name" class="form-control form-control-solid" value="{{$companiesData->name}}" placeholder="Enter Company Name"/>
                                                           </div>
                                                       </div>
                                                       <div class="row g-9 mb-8">
                                                           <div class="col-md-12 fv-row">
                                                               <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Company Email</label>
                                                               <input type="text" name="email" class="form-control form-control-solid" value="{{$companiesData->email}}" placeholder="Enter Company Email"/>
                                                           </div>
                                                       </div>
                                                       <div class="row g-9 mb-8">
                                                           <div class="col-md-12 fv-row">
                                                               <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Company Phone</label>
                                                               <input type="text" name="phone" class="form-control form-control-solid" value="{{$companiesData->phone}}" placeholder="Enter Company Phone"/>
                                                           </div>
                                                       </div>
                                                       <div class="row g-9 mb-8">
                                                           <div class="col-md-12 fv-row">
                                                               <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Company Address</label>
                                                               <input type="text" name="address" class="form-control form-control-solid" value="{{$companiesData->address}}" placeholder="Enter Company Address"/>
                                                           </div>
                                                       </div>

                                                       <div class="row g-9 mb-8">
                                                           <div class="col-md-12 fv-row">
                                                               <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Company Logo</label>
                                                               <input type="file" name="logo" class="form-control form-control-solid" placeholder="Enter Company Logo"/>
                                                                <img src="{{ asset($companiesData->logo) }}" alt="" style="height: 50px; width: 50px;" class="img-fluid" id="picture__preview">
                                                           </div>
                                                       </div>


                                                        <div class="row g-9 mb-8">
                                                          <div class="col-md-12 fv-row">
                                                              <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Company Trade License</label>
                                                              <input type="file" name="trade_license" class="form-control form-control-solid" placeholder="Enter Company Trade License"/>
                                                          </div>
                                                        </div>

                                                        <div class="row g-9 mb-8">
                                                              <div class="col-md-12 fv-row">
                                                                  <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Password</label>
                                                                  <input type="password" name="password" class="form-control form-control-solid" placeholder="Enter Password"/>
                                                              </div>
                                                        </div>


                                                        {{--status make--}}
                                                        <div class="row g-9 mb-8">
                                                            <div class="col-md-12 fv-row">
                                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Status</label>
                                                                <select name="status" class="form-select form-select-solid">
                                                                    <option value="active" {{$companiesData->status == 'active' ? 'selected' : ''}}>Active</option>
                                                                    <option value="inactive" {{$companiesData->status == 'inactive' ? 'selected' : ''}}>Inactive</option>
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

                                <div class="modal fade" id="deleteModal{{$companiesData->id}}" tabindex="-1" aria-labelledby="deleteModalLabel{{$companiesData->id}}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{$companiesData->id}}">Delete Relation</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete Company?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <a href="{{route('admin.company.delete',$companiesData->id)}}" class="btn btn-danger">Delete</a>
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
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <div class="modal-content rounded">
                    <div class="modal-header pb-0 border-0 justify-content-end">
                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                            <i class="ki-outline ki-cross fs-1"></i>
                        </div>
                    </div>
                    <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                        <form action="{{route('admin.company.store')}}" method="post" class="form" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-13 text-center">
                                <h1 class="mb-3">Add Company</h1>
                            </div>
                            <div class="row g-9 mb-8">
                                <div class="col-md-12 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Company Name</label>
                                    <input type="text" name="name" class="form-control form-control-solid" placeholder="Enter Company Name"/>
                                </div>
                            </div>
                            <div class="row g-9 mb-8">
                                <div class="col-md-12 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Company Email</label>
                                    <input type="text" name="email" class="form-control form-control-solid" placeholder="Enter Company Email"/>
                                </div>
                            </div>
                            <div class="row g-9 mb-8">
                                <div class="col-md-12 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Company Phone</label>
                                    <input type="text" name="phone" class="form-control form-control-solid" placeholder="Enter Company Phone"/>
                                </div>
                            </div>
                            <div class="row g-9 mb-8">
                                <div class="col-md-12 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Company Address</label>
                                    <input type="text" name="address" class="form-control form-control-solid" placeholder="Enter Company Address"/>
                                </div>
                            </div>

                            <div class="row g-9 mb-8">
                                <div class="col-md-12 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Company Logo</label>
                                    <input type="file" name="logo" class="form-control form-control-solid" placeholder="Enter Company Logo"/>
                                </div>
                            </div>


                            <div class="row g-9 mb-8">
                              <div class="col-md-12 fv-row">
                                  <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Company Trade License</label>
                                  <input type="file" name="trade_license" class="form-control form-control-solid" placeholder="Enter Company Trade License"/>
                              </div>
                            </div>

                          <div class="row g-9 mb-8">
                              <div class="col-md-12 fv-row">
                                  <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Password</label>
                                  <input type="password" name="password" class="form-control form-control-solid" placeholder="Enter Password"/>
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
