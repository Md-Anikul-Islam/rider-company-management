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
                        <a href="#" class="text-muted text-hover-primary">Agent</a>
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
                                <th>Agent Profile</th>
                                <th>Agent Name</th>
                                <th>Agent Email</th>
                                <th>Agent Phone</th>
                                <th>Agent Address</th>
                                <th>Agent Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                @foreach($agent as $key=>$agentData)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                     <img src="{{ asset($agentData->profile) }}" alt="" style="height: 50px; width: 50px;" class="img-fluid" id="picture__preview">
                                    </td>
                                    <td>{{$agentData->name}}</td>
                                    <td>{{$agentData->email}}</td>
                                    <td>{{$agentData->phone}}</td>
                                    <td>{{$agentData->address}}</td>
                                    <td>
                                        @if( $agentData->status == 'active')
                                            <span class="badge badge-success">Active</span>
                                        @elseif( $agentData->status == 'inactive')
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
                                                   <a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#modalFormDataEdit{{$agentData->id}}"><i class="fa-solid fa-edit"></i> Edit</a>
                                               </li>
                                               <li>
                                                  <a class="dropdown-item" href="{{route('admin.agent.delete',$agentData->id)}}"  data-bs-toggle="modal" data-bs-target="#deleteModal{{$agentData->id}}" data-category-id="{{$agentData->id}}"><i class="fa-solid fa-trash"></i> Delete</a>
                                               </li>
                                           </ul>
                                       </div>
                                    </td>
                                </tr>

                                <!-- Edit Modal for Current Relation -->
                                <div class="modal fade" id="modalFormDataEdit{{$agentData->id}}" aria-labelledby="editModalLabel{{$agentData->id}}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered mw-650px">
                                        <div class="modal-content rounded">
                                            <div class="modal-header pb-0 border-0 justify-content-end">
                                                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                                    <i class="ki-outline ki-cross fs-1"></i>
                                                </div>
                                            </div>
                                            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                                                <form action="{{route('admin.agent.update',$agentData->id)}}" method="post" class="form" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-13 text-center">
                                                        <h1 id="editModalLabel{{$agentData->id}}" class="mb-3">Edit Agent</h1>
                                                    </div>
                                                    <div class="row g-9 mb-8">
                                                           <div class="col-md-12 fv-row">
                                                               <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Agent Name</label>
                                                               <input type="text" name="name" class="form-control form-control-solid" value="{{$agentData->name}}" placeholder="Enter Agent Name"/>
                                                           </div>
                                                       </div>
                                                       <div class="row g-9 mb-8">
                                                           <div class="col-md-12 fv-row">
                                                               <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Agent Email</label>
                                                               <input type="text" name="email" class="form-control form-control-solid" value="{{$agentData->email}}" placeholder="Enter Agent Email"/>
                                                           </div>
                                                       </div>
                                                       <div class="row g-9 mb-8">
                                                           <div class="col-md-12 fv-row">
                                                               <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Agent Phone</label>
                                                               <input type="text" name="phone" class="form-control form-control-solid" value="{{$agentData->phone}}" placeholder="Enter Agent Phone"/>
                                                           </div>
                                                       </div>
                                                       <div class="row g-9 mb-8">
                                                           <div class="col-md-12 fv-row">
                                                               <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Agent Address</label>
                                                               <input type="text" name="address" class="form-control form-control-solid" value="{{$agentData->address}}" placeholder="Enter Agent Address"/>
                                                           </div>
                                                       </div>

                                                       <div class="row g-9 mb-8">
                                                           <div class="col-md-12 fv-row">
                                                               <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Agent Profile</label>
                                                               <input type="file" name="profile" class="form-control form-control-solid" placeholder="Enter Agent Profile"/>
                                                                <img src="{{ asset($agentData->profile) }}" alt="" style="height: 50px; width: 50px;" class="img-fluid" id="picture__preview">
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
                                                                    <option value="active" {{$agentData->status == 'active' ? 'selected' : ''}}>Active</option>
                                                                    <option value="inactive" {{$agentData->status == 'inactive' ? 'selected' : ''}}>Inactive</option>
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

                                <div class="modal fade" id="deleteModal{{$agentData->id}}" tabindex="-1" aria-labelledby="deleteModalLabel{{$agentData->id}}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{$agentData->id}}">Delete Agent</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete Company?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <a href="{{route('admin.agent.delete',$agentData->id)}}" class="btn btn-danger">Delete</a>
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
                        <form action="{{route('admin.agent.store')}}" method="post" class="form" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-13 text-center">
                                <h1 class="mb-3">Add Agent</h1>
                            </div>
                            <div class="row g-9 mb-8">
                                <div class="col-md-12 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Agent Name</label>
                                    <input type="text" name="name" class="form-control form-control-solid" placeholder="Enter Agent Name"/>
                                </div>
                            </div>
                            <div class="row g-9 mb-8">
                                <div class="col-md-12 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Agent Email</label>
                                    <input type="text" name="email" class="form-control form-control-solid" placeholder="Enter Agent Email"/>
                                </div>
                            </div>
                            <div class="row g-9 mb-8">
                                <div class="col-md-12 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Agent Phone</label>
                                    <input type="text" name="phone" class="form-control form-control-solid" placeholder="Enter Agent Phone"/>
                                </div>
                            </div>
                            <div class="row g-9 mb-8">
                                <div class="col-md-12 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Agent Address</label>
                                    <input type="text" name="address" class="form-control form-control-solid" placeholder="Enter Agent Address"/>
                                </div>
                            </div>

                            <div class="row g-9 mb-8">
                                <div class="col-md-12 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Agent Profile</label>
                                    <input type="file" name="profile" class="form-control form-control-solid" placeholder="Enter Profile Logo"/>
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
