@extends('admin.layout')
@section('admin_content'))
<div class="toolbar" id="kt_toolbar">
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center me-3 flex-wrap lh-1">
            <h1 class="d-flex align-items-center text-dark fw-bold my-1 fs-3"> Admin</h1>
            <span class="h-20px border-gray-200 border-start mx-4"></span>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-1">
                <li class="breadcrumb-item text-muted">
                    <a href="#" class="text-muted text-hover-primary">Company Details</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="post d-flex flex-column-fluid mb-5" id="kt_post">
    <div id="kt_content_container" class="container-fluid">
        <div class="card mb-6 mb-xl-9">
          <div class="card-body pt-9 pb-0">
              <!--begin::Details-->
              <div
                  class="d-flex flex-wrap flex-sm-nowrap mb-6"
              >
                  <!--begin::Image-->
                  <div
                      class="d-flex flex-center flex-shrink-0 bg-light rounded w-100px h-100px w-lg-150px h-lg-150px me-7 mb-4"
                  >
                      <img
                          class="mw-50px mw-lg-75px"
                          src="{{asset($company->logo)}}"
                          alt="image"
                      />
                  </div>
                  <!--end::Image-->

                  <!--begin::Wrapper-->
                  <div class="flex-grow-1">
                      <!--begin::Head-->
                      <div
                          class="d-flex justify-content-between align-items-start flex-wrap mb-2"
                      >
                          <!--begin::Details-->
                          <div
                              class="d-flex flex-column"
                          >
                              <!--begin::Status-->
                              <div
                                  class="d-flex align-items-center mb-1"
                              >
                                  <h3
                                      class="text-gray-800 text-hover-primary fs-2 fw-bold me-3"
                                  >
                                      {{$company->name}}
                                  </h3>
                                  <span
                                      class="badge badge-light-success me-auto"
                                      >Company
                                      Information</span
                                  >
                              </div>
                              <!--end::Status-->

                              <!--begin::Description-->
                              <div
                                  class="d-flex align-items-center mb-4"
                              >
                                  <i
                                      class="ki-duotone ki-map fs-2x me-2"
                                  >
                                      <span
                                          class="path1"
                                      ></span>
                                      <span
                                          class="path2"
                                      ></span>
                                      <span
                                          class="path3"
                                      ></span>
                                  </i>
                                  <div
                                      class="d-flex flex-wrap fw-semibold fs-5 text-gray-500"
                                  >
                                      {{$company->address}}
                                  </div>
                              </div>
                              <!--end::Description-->
                          </div>
                          <!--end::Details-->
                      </div>
                      <!--end::Head-->

                      <!--begin::Info-->
                      <div
                          class="d-flex flex-wrap justify-content-start"
                      >
                          <!--begin::Stats-->
                          <div
                              class="d-flex flex-wrap"
                          >
                              <!--begin::Stat-->
                              <div
                                  class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3"
                              >
                                  <!--begin::Number-->
                                  <div
                                      class="d-flex align-items-center"
                                  >
                                      <div
                                          class="fs-4 fw-bold"
                                      >
                                          Email
                                          Address
                                      </div>
                                  </div>
                                  <!--end::Number-->

                                  <!--begin::Label-->
                                  <div
                                      class="fw-semibold fs-6 text-gray-500"
                                  >
                                     {{$company->email}}
                                  </div>
                                  <!--end::Label-->
                              </div>
                              <div
                                  class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3"
                              >
                                  <!--begin::Number-->
                                  <div
                                      class="d-flex align-items-center"
                                  >
                                      <div
                                          class="fs-4 fw-bold"
                                      >
                                          Phone Number
                                      </div>
                                  </div>
                                  <!--end::Number-->

                                  <!--begin::Label-->
                                  <div
                                      class="fw-semibold fs-6 text-gray-500"
                                  >
                                       {{$company->phone}}
                                  </div>
                                  <!--end::Label-->
                              </div>
                              <!--begin::Stat-->
                              <div
                                  class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3"
                              >
                                  <div
                                      class="d-flex align-items-center"
                                  >
                                      <!--begin::Icon-->
                                      <div
                                          class="symbol symbol-30px me-5"
                                      >
                                          <img
                                              alt="Icon"
                                              src="https://preview.keenthemes.com/metronic8/demo13/assets/media/svg/files/pdf.svg"
                                          />
                                      </div>
                                      <!--end::Icon-->

                                      <!--begin::Details-->
                                      <div
                                          class="fw-semibold"
                                      >
                                          <a
                                              class="fs-6 fw-bold text-gray-900 text-hover-primary"
                                              href="#"
                                              target="_blank"
                                              >Company
                                              Trade
                                              License</a
                                          >

                                          <div
                                              class="text-gray-500"
                                          >
                                              <a
                                                  href="{{asset($company->trade_license)}}"
                                                  target="_blank"
                                                  >View</a
                                              >
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <!--end::Stat-->
                          </div>
                      </div>
                      <!--end::Info-->
                  </div>
                  <!--end::Wrapper-->
              </div>
              <!--end::Details-->
          </div>
        </div>

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
                        </tr>
                       @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



@endsection