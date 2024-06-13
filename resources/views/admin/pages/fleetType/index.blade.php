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
                        <a href="#" class="text-muted text-hover-primary">Fleet Type</a>
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
                                <th>Fleet Type Name</th>
                                <th>Fleet Type Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                @foreach($fleetType as $key=>$fleetTypeData)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$fleetTypeData->name}}</td>
                                     <td>
                                        @if( $fleetTypeData->status == 'active')
                                            <span class="badge badge-success">Active</span>
                                        @elseif( $fleetTypeData->status == 'inactive')
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalFormDataEdit{{$fleetTypeData->id}}">Edit</button>
                                        <a href="{{route('admin.fleetType.delete',$fleetTypeData->id)}}" class="btn btn-danger btn-sm delete-division" data-bs-toggle="modal" data-bs-target="#deleteModal{{$fleetTypeData->id}}" data-category-id="{{$fleetTypeData->id}}">Delete</a>
                                    </td>
                                </tr>

                                <!-- Edit Modal for Current Relation -->
                                <div class="modal fade" id="modalFormDataEdit{{$fleetTypeData->id}}" aria-labelledby="editModalLabel{{$fleetTypeData->id}}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered mw-650px">
                                        <div class="modal-content rounded">
                                            <div class="modal-header pb-0 border-0 justify-content-end">
                                                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                                    <i class="ki-outline ki-cross fs-1"></i>
                                                </div>
                                            </div>
                                            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                                                <form action="{{route('admin.fleetType.update',$fleetTypeData->id)}}" method="post" class="form">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-13 text-center">
                                                        <h1 id="editModalLabel{{$fleetTypeData->id}}" class="mb-3">Edit Fleet Type</h1>
                                                    </div>
                                                       <div class="row g-9 mb-8">
                                                           <div class="col-md-12 fv-row">
                                                               <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Fleet Type Name</label>
                                                               <input type="text" name="name" class="form-control form-control-solid" value="{{$fleetTypeData->name}}" placeholder="Enter Fleet Type Name"/>
                                                           </div>
                                                       </div>

                                                        {{--status make--}}
                                                        <div class="row g-9 mb-8">
                                                            <div class="col-md-12 fv-row">
                                                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Status</label>
                                                                <select name="status" class="form-select form-select-solid">
                                                                    <option value="active" {{$fleetTypeData->status == 'active' ? 'selected' : ''}}>Active</option>
                                                                    <option value="inactive" {{$fleetTypeData->status == 'inactive' ? 'selected' : ''}}>Inactive</option>
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

                                <div class="modal fade" id="deleteModal{{$fleetTypeData->id}}" tabindex="-1" aria-labelledby="deleteModalLabel{{$fleetTypeData->id}}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{$fleetTypeData->id}}">Delete Relation</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete Fleet Type?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <a href="{{route('admin.fleetType.delete',$fleetTypeData->id)}}" class="btn btn-danger">Delete</a>
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
                        <form action="{{route('admin.fleetType.store')}}" method="post" class="form" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-13 text-center">
                                <h1 class="mb-3">Add Company</h1>
                            </div>
                              <div class="row g-9 mb-8">
                                  <div class="col-md-12 fv-row">
                                      <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Fleet Type Name</label>
                                      <input type="text" name="name" class="form-control form-control-solid" placeholder="Enter Fleet Type Name"/>
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
