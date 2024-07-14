@extends('company.layout')
@section('company_content')
<div class="toolbar" id="kt_toolbar">
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center me-3 flex-wrap lh-1">
            <h1 class="d-flex align-items-center text-dark fw-bold my-1 fs-3"> Company</h1>
            <span class="h-20px border-gray-200 border-start mx-4"></span>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-1">
                <li class="breadcrumb-item text-muted">
                    <a href="#" class="text-muted text-hover-primary">Fleet</a>
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
                            <th>Image</th>
                            <th>Type</th>
                            <th>Maker</th>
                            <th>Model</th>
                            <th>Plate No</th>
                            <th>Name</th>
                            <th>Year</th>
                            <th>Color</th>
                            <th>Registered Card</th>
                            <th>Selected</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                        @foreach($cars as $key=>$carData)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                <img src="{{ asset($carData->car_image) }}" alt="" style="height: 50px; width: 50px;" class="img-fluid" id="picture__preview">
                            </td>
                            <td>{{ $carData->fleetType ? $carData->fleetType->name : 'N/A' }}</td>
                            <td>{{ $carData->fleetMake ? $carData->fleetMake->car_make_name : 'N/A' }}</td>
                            <td>{{ $carData->fleetModel ? $carData->fleetModel->car_model_name : 'N/A' }}</td>
                            <td>{{$carData->plate_no}}</td>
                            <td>{{$carData->car_name}}</td>
                            <td>{{$carData->year}}</td>
                            <td>{{$carData->car_color}}</td>
                            <td>
                                <img src="{{ asset($carData->car_register_card) }}" alt="" style="height: 50px; width: 50px;" class="img-fluid" id="picture__preview">
                            </td>
                            <td>
                                @if( $carData->is_selected == 'yes')
                                    <span class="badge badge-danger">YES</span>
                                @elseif( $carData->is_selected == 'no')
                                    <span class="badge badge-success">NO</span>
                                @endif
                            </td>
                            <td>
                                @if( $carData->status == 'active')
                                    <span class="badge badge-success">Active</span>
                                @elseif( $carData->status == 'inactive')
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
                                           <a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#modalFormDataEdit{{$carData->id}}"><i class="fa-solid fa-edit"></i> Edit</a>
                                       </li>
                                       <li>
                                          <a class="dropdown-item" href="{{route('company.car.delete',$carData->id)}}"  data-bs-toggle="modal" data-bs-target="#deleteModal{{$carData->id}}" data-category-id="{{$carData->id}}"><i class="fa-solid fa-trash"></i> Delete</a>
                                       </li>
                                   </ul>
                               </div>
                            </td>
                        </tr>
                        <!-- Edit Modal for Current Relation -->
                        <div class="modal fade" id="modalFormDataEdit{{$carData->id}}" aria-labelledby="editModalLabel{{$carData->id}}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered mw-1000px">
                                <div class="modal-content rounded">
                                    <div class="modal-header pb-0 border-0 justify-content-end">
                                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                            <i class="ki-outline ki-cross fs-1"></i>
                                        </div>
                                    </div>
                                    <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                                        <form action="{{route('company.car.update',$carData->id)}}" method="post" class="form" enctype="multipart/form-data">
                                        @csrf @method('PUT')
                                        <div class="mb-13 text-center">
                                                <h1 id="editModalLabel{{$carData->id}}" class="mb-3">Edit Car/Fleet</h1>
                                            </div>
                                            <div class="row g-9 mb-8">
                                               <div class="col-md-6 fv-row">
                                                   <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Fleet Type</label>
                                                   <select name="fleet_type_id" class="form-select form-select-solid fleet-type-select-for-edit" required>
                                                         <option value="">Select Fleet Type</option>
                                                       @foreach($carTypes as $carTypeData)
                                                           <option value="{{$carTypeData->id}}" {{$carData->fleet_type_id == $carTypeData->id ? 'selected' : ''}}>{{$carTypeData->name}}</option>
                                                       @endforeach
                                                   </select>
                                               </div>

                                                <div class="col-md-6 fv-row">
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Fleet Maker</label>
                                                    <select name="fleet_make_id" class="form-select form-select-solid fleet-make-select-for-edit" required>
                                                        <!-- Options will be populated dynamically -->
                                                       <option value="{{$carData->fleet_make_id}}" selected>{{$carData->fleetMake->car_make_name}}</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-6 fv-row">
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Fleet Model</label>
                                                    <select name="fleet_model_id" class="form-select form-select-solid fleet-model-select-for-edit" required>
                                                        <!-- Options will be populated dynamically -->
                                                        <option value="{{$carData->fleet_model_id}}" selected>{{$carData->fleetModel->car_model_name}}</option>
                                                    </select>
                                                </div>

{{--                                              <div class="col-md-6 fv-row">--}}
{{--                                                   <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Fleet Maker</label>--}}
{{--                                                   <input disabled type="text" name="{{$carData->fleet_make_id}}" class="form-control form-control-solid" value="{{$carData->fleetMake->car_make_name}}" placeholder="Enter Car Image" />--}}
{{--                                              </div>--}}

{{--                                               <div class="col-md-6 fv-row">--}}
{{--                                                   <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Fleet Model</label>--}}
{{--                                                   <input disabled  type="text" name="{{$carData->fleet_model_id}}" class="form-control form-control-solid" value="{{$carData->fleetModel->car_model_name}}" placeholder="Enter Car Image" />--}}
{{--                                               </div>--}}

                                                <div class="col-md-6 fv-row">
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Car Image</label>
                                                    <input type="file" name="car_image" class="form-control form-control-solid" value="{{$carData->car_image}}" placeholder="Enter Car Image" />
                                                </div>
                                            </div>
                                            <div class="row g-9 mb-8">
                                                <div class="col-md-6 fv-row">
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Car Register Card</label>
                                                    <input type="file" name="car_register_card" class="form-control form-control-solid" value="{{$carData->car_register_card}}" placeholder="Enter Car Register Card" />
                                                </div>
                                                <div class="col-md-6 fv-row">
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Car Plate No</label>
                                                    <input type="text" name="plate_no" class="form-control form-control-solid" value="{{$carData->plate_no}}" placeholder="Enter Car Plate No" />
                                                </div>
                                            </div>
                                            <div class="row g-9 mb-8">
                                                <div class="col-md-6 fv-row">
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Car Name</label>
                                                    <input type="text" name="car_name" class="form-control form-control-solid" value="{{$carData->car_name}}" placeholder="Enter Car Name" />
                                                </div>
                                                <div class="col-md-6 fv-row">
                                                   <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Year</label>
                                                   <select name="year" class="form-select form-select-solid">
                                                       @for($year = 1990; $year <= date('Y'); $year++)
                                                           <option value="{{$year}}" {{$carData->year == $year ? 'selected' : ''}}>{{$year}}</option>
                                                       @endfor
                                                   </select>
                                               </div>
                                            </div>

                                            <div class="row g-9 mb-8">
                                                <div class="col-md-6 fv-row">
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Car Color</label>
                                                    <input type="text" name="car_color" class="form-control form-control-solid" value="{{$carData->car_color}}" placeholder="Enter Car Color" />
                                                </div>

                                                <div class="col-md-6 fv-row">
                                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Status</label>
                                                    <select name="status" class="form-select form-select-solid">
                                                        <option value="active" {{$carData->status == 'active' ? 'selected' : ''}}>Active</option>
                                                        <option value="inactive" {{$carData->status == 'inactive' ? 'selected' : ''}}>Inactive</option>
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
                        <div class="modal fade" id="deleteModal{{$carData->id}}" tabindex="-1" aria-labelledby="deleteModalLabel{{$carData->id}}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{$carData->id}}">Delete Relation</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete Car?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <a href="{{route('company.car.delete',$carData->id)}}" class="btn btn-danger">Delete</a>
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
                <form action="{{route('company.car.store')}}" method="post" class="form" enctype="multipart/form-data"> @csrf <div class="mb-13 text-center">
                        <h1 class="mb-3">Add Company</h1>
                    </div>
                    <div class="row g-9 mb-8">

                        <div class="col-md-6 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Fleet Type</label>
                            <select name="fleet_type_id" class="form-select form-select-solid fleet-type-select" required>
                                <option value="">Select Fleet Type</option>
                                @foreach($carTypes as $carTypeData)
                                    <option value="{{$carTypeData->id}}">{{$carTypeData->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Fleet Maker</label>
                            <select name="fleet_make_id" class="form-select form-select-solid fleet-make-select" required>
                                <!-- Options will be populated dynamically -->
                            </select>
                        </div>

                        <div class="col-md-6 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Fleet Model</label>
                            <select name="fleet_model_id" class="form-select form-select-solid fleet-model-select" required>
                                <!-- Options will be populated dynamically -->
                            </select>
                        </div>

                        <div class="col-md-6 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Car Image</label>
                            <input type="file" name="car_image" class="form-control form-control-solid" placeholder="Enter Car Image" />
                        </div>
                    </div>
                    <div class="row g-9 mb-8">
                        <div class="col-md-6 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Car Register Card</label>
                            <input type="file" name="car_register_card" class="form-control form-control-solid" placeholder="Enter Car Register Card" />
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Car Plate No</label>
                            <input type="text" name="plate_no" class="form-control form-control-solid" placeholder="Enter Car Plate No" />
                        </div>
                    </div>
                    <div class="row g-9 mb-8">
                        <div class="col-md-6 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Car Name</label>
                            <input type="text" name="car_name" class="form-control form-control-solid" placeholder="Enter Car Name" />
                        </div>
                        <div class="col-md-6 fv-row">
                             <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Car Color</label>
                             <input type="text" name="car_color" class="form-control form-control-solid" placeholder="Enter Car Color" />
                         </div>
                    </div>

                    <div class="row g-9 mb-8">
                        <div class="col-md-6 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Year</label>
                            <select name="year" class="form-select form-select-solid"> @for($year = 1990; $year <= date('Y'); $year++) <option value="{{$year}}">{{$year}}</option> @endfor </select>
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
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.body.addEventListener('change', function (event) {
        if (event.target.classList.contains('fleet-type-select')) {
            const fleetTypeId = event.target.value;
            const fleetMakeSelect = event.target.closest('.fv-row').nextElementSibling.querySelector('.fleet-make-select');
            const fleetModelSelect = event.target.closest('.fv-row').nextElementSibling.nextElementSibling.querySelector('.fleet-model-select');

            fetch(`/company/get-fleet-makes/${fleetTypeId}`)
                .then(response => response.json())
                .then(data => {
                    fleetMakeSelect.innerHTML = '<option value="">Select Fleet Make</option>';
                    fleetModelSelect.innerHTML = '<option value="">Select Fleet Model</option>';
                    data.forEach(make => {
                        const option = document.createElement('option');
                        option.value = make.id;
                        option.textContent = make.car_make_name;
                        fleetMakeSelect.appendChild(option);
                    });
                });
        }

        if (event.target.classList.contains('fleet-make-select')) {
            const fleetMakeId = event.target.value;
            const fleetModelSelect = event.target.closest('.fv-row').nextElementSibling.querySelector('.fleet-model-select');

            fetch(`/company/get-fleet-models/${fleetMakeId}`)
                .then(response => response.json())
                .then(data => {
                    fleetModelSelect.innerHTML = '<option value="">Select Fleet Model</option>';
                    data.forEach(model => {
                        const option = document.createElement('option');
                        option.value = model.id;
                        option.textContent = model.car_model_name;
                        fleetModelSelect.appendChild(option);
                    });
                });
        }
    });
});

</script>

{{--for edit modal--}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.body.addEventListener('change', function (event) {
        if (event.target.classList.contains('fleet-type-select-for-edit')) {
            const fleetTypeId = event.target.value;
            const fleetMakeSelect = event.target.closest('.fv-row').nextElementSibling.querySelector('.fleet-make-select-for-edit');
            const fleetModelSelect = event.target.closest('.fv-row').nextElementSibling.nextElementSibling.querySelector('.fleet-model-select-for-edit');

            fetch(`/company/get-fleet-makes/${fleetTypeId}`)
                .then(response => response.json())
                .then(data => {
                    fleetMakeSelect.innerHTML = '<option value="">Select Fleet Make</option>';
                    fleetModelSelect.innerHTML = '<option value="">Select Fleet Model</option>';
                    data.forEach(make => {
                        const option = document.createElement('option');
                        option.value = make.id;
                        option.textContent = make.car_make_name;
                        fleetMakeSelect.appendChild(option);
                    });
                });
        }

        if (event.target.classList.contains('fleet-make-select-for-edit')) {
            const fleetMakeId = event.target.value;
            const fleetModelSelect = event.target.closest('.fv-row').nextElementSibling.querySelector('.fleet-model-select-for-edit');

            fetch(`/company/get-fleet-models/${fleetMakeId}`)
                .then(response => response.json())
                .then(data => {
                    fleetModelSelect.innerHTML = '<option value="">Select Fleet Model</option>';
                    data.forEach(model => {
                        const option = document.createElement('option');
                        option.value = model.id;
                        option.textContent = model.car_model_name;
                        fleetModelSelect.appendChild(option);
                    });
                });
        }
    });
});

</script>


@endsection