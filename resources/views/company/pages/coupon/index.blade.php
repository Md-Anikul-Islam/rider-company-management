@extends('company.layout')
@section('company_content')
<div class="toolbar" id="kt_toolbar">
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center me-3 flex-wrap lh-1">
            <h1 class="d-flex align-items-center text-dark fw-bold my-1 fs-3"> Company</h1>
            <span class="h-20px border-gray-200 border-start mx-4"></span>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-1">
                <li class="breadcrumb-item text-muted">
                    <a href="#" class="text-muted text-hover-primary">Coupon</a>
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
                            <th>Code</th>
                            <th>Discount Type</th>
                            <th>Discount Amount</th>
                            <th>Valid From</th>
                            <th>Valid To</th>
                            <th>Max Use</th>
                            <th>Max Order Amount</th>
                            <th>Short Note</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                        @foreach($coupon as $key=>$couponData)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$couponData->code}}</td>
                            <td>{{$couponData->discount_type}}</td>
                            <td>{{$couponData->discount_amount}}</td>
                            <td>{{ \Carbon\Carbon::parse($couponData->valid_from)->format('d M Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($couponData->valid_to)->format('d M Y') }}</td>
                            <td>{{$couponData->max_uses}}</td>
                            <td>{{$couponData->max_amount_to_apply}}</td>
                            <td>{{$couponData->short_note}}</td>
                            <td>
                                @if( $couponData->status == 'active')
                                    <span class="badge badge-success">Active</span>
                                @elseif( $couponData->status == 'inactive')
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
                                           <a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#modalFormDataEdit{{$couponData->id}}"><i class="fa-solid fa-edit"></i> Edit</a>
                                       </li>
                                       <li>
                                          <a class="dropdown-item" href="{{route('company.coupon.delete',$couponData->id)}}"  data-bs-toggle="modal" data-bs-target="#deleteModal{{$couponData->id}}" data-category-id="{{$couponData->id}}"><i class="fa-solid fa-trash"></i> Delete</a>
                                       </li>
                                   </ul>
                               </div>
                            </td>

                        </tr>
                        <!-- Edit Modal for Current Relation -->
                        <div class="modal fade" id="modalFormDataEdit{{$couponData->id}}" aria-labelledby="editModalLabel{{$couponData->id}}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered mw-1000px">
                                <div class="modal-content rounded">
                                    <div class="modal-header pb-0 border-0 justify-content-end">
                                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                            <i class="ki-outline ki-cross fs-1"></i>
                                        </div>
                                    </div>
                                    <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                                        <form action="{{route('company.coupon.update',$couponData->id)}}" method="post" class="form">
                                        @csrf
                                        @method('PUT')
                                           <div class="mb-13 text-center">
                                                <h1 id="editModalLabel{{$couponData->id}}" class="mb-3">Edit Coupon</h1>
                                            </div>
                                            <div class="row g-9 mb-8">
                                                <div class="col-md-6 fv-row">
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Code</label>
                                                    <input type="text" name="code" class="form-control form-control-solid" value="{{$couponData->code}}" placeholder="Enter Code" />
                                                </div>
                                                <div class="col-md-6 fv-row">
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Discount Type</label>
                                                    <select name="discount_type" class="form-select form-select-solid" required>
                                                        <option value="percentage" {{ $couponData->discount_type === 'percentage' ? 'selected' : '' }}>Percentage</option>
                                                        <option value="fixed_amount" {{ $couponData->discount_type === 'fixed_amount' ? 'selected' : '' }}>Fixed Amount</option>
                                                    </select>
                                                </div>
                                            </div>

                                             <div class="row g-9 mb-8">
                                                <div class="col-md-6 fv-row">
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Discount Amount</label>
                                                    <input type="text" name="discount_amount" class="form-control form-control-solid" value="{{$couponData->discount_amount}}" placeholder="Enter Discount Amount" />
                                                </div>
                                                <div class="col-md-6 fv-row">
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Valid From</label>
                                                    <input type="text" name="valid_from" class="form-control form-control-solid" value="{{ \Carbon\Carbon::parse($couponData->valid_from)->format('d M Y') }}" placeholder="Valid From" />
                                                </div>
                                             </div>

                                             <div class="row g-9 mb-8">
                                                 <div class="col-md-6 fv-row">
                                                     <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Valid To</label>
                                                     <input type="text" name="valid_to" class="form-control form-control-solid" value="{{ \Carbon\Carbon::parse($couponData->valid_to)->format('d M Y') }}" placeholder="Valid To" />
                                                 </div>
                                                 <div class="col-md-6 fv-row">
                                                     <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Max Uses</label>
                                                     <input type="number" name="max_uses" class="form-control form-control-solid"  value="{{$couponData->max_uses}}" placeholder="Max Uses" />
                                                 </div>
                                             </div>


                                            <div class="row g-9 mb-8">
                                                <div class="col-md-6 fv-row">
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Max Amount To Apply</label>
                                                    <input type="number" name="max_amount_to_apply" class="form-control form-control-solid" value="{{$couponData->max_amount_to_apply}}" placeholder="Enter Max Amount To Apply" />
                                                </div>
                                                <div class="col-md-6 fv-row">
                                                   <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Short Note</label>
                                                   <input type="text" name="short_note" class="form-control form-control-solid" value="{{$couponData->short_note}}" placeholder="Enter Short Note" />
                                                </div>
                                            </div>

                                            <div class="row g-9 mb-8">
                                                <div class="col-md-12 fv-row">
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Status</label>
                                                    <select name="status" class="form-select form-select-solid">
                                                        <option value="active" {{$couponData->status == 'active' ? 'selected' : ''}}>Active</option>
                                                        <option value="inactive" {{$couponData->status == 'inactive' ? 'selected' : ''}}>Inactive</option>
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
                        <div class="modal fade" id="deleteModal{{$couponData->id}}" tabindex="-1" aria-labelledby="deleteModalLabel{{$couponData->id}}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{$couponData->id}}">Delete Coupon</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete Coupon?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <a href="{{route('company.coupon.delete',$couponData->id)}}" class="btn btn-danger">Delete</a>
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
                <form action="{{route('company.coupon.store')}}" method="post" class="form" enctype="multipart/form-data">
                 @csrf
                    <div class="mb-13 text-center">
                        <h1 class="mb-3">Add Coupon</h1>
                    </div>
                    <div class="row g-9 mb-8">
                       <div class="col-md-6 fv-row">
                           <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Code</label>
                           <input type="text" name="code" class="form-control form-control-solid"  placeholder="Enter Code" />
                       </div>
                       <div class="col-md-6 fv-row">
                           <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Discount Type</label>
                           <select name="discount_type" class="form-select form-select-solid" required>
                               <option value="percentage">Percentage</option>
                               <option value="fixed_amount">Fixed Amount</option>
                           </select>
                       </div>
                   </div>

                    <div class="row g-9 mb-8">
                       <div class="col-md-6 fv-row">
                           <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Discount Amount</label>
                           <input type="number" name="discount_amount" class="form-control form-control-solid" placeholder="Enter Discount Amount" />
                       </div>
                       <div class="col-md-6 fv-row">
                           <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Valid From</label>
                           <input type="date" name="valid_from" class="form-control form-control-solid" placeholder="Valid From" />
                       </div>
                    </div>

                    <div class="row g-9 mb-8">
                        <div class="col-md-6 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Valid To</label>
                            <input type="date" name="valid_to" class="form-control form-control-solid"  placeholder="Valid To" />
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Max Uses</label>
                            <input type="number" name="max_uses" class="form-control form-control-solid"  placeholder="Max Uses" />
                        </div>
                    </div>


                   <div class="row g-9 mb-8">
                       <div class="col-md-6 fv-row">
                           <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Max Amount To Apply</label>
                           <input type="number" name="max_amount_to_apply" class="form-control form-control-solid"  placeholder="Enter Max Amount To Apply" />
                       </div>
                       <div class="col-md-6 fv-row">
                          <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Short Note</label>
                          <input type="text" name="short_note" class="form-control form-control-solid"  placeholder="Enter Short Note" />
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