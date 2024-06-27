@extends('admin.layout')
@section('admin_content'))
<div class="toolbar" id="kt_toolbar">
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center me-3 flex-wrap lh-1">
            <h1 class="d-flex align-items-center text-dark fw-bold my-1 fs-3"> Admin</h1>
            <span class="h-20px border-gray-200 border-start mx-4"></span>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-1">
                <li class="breadcrumb-item text-muted">
                    <a href="#" class="text-muted text-hover-primary">Driver Details</a>
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
                          src="https://preview.keenthemes.com/metronic8/demo13/assets/media/svg/brand-logos/volicity-9.svg"
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
                                      {{$driver->company->name}}
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
                                      {{$driver->company->address}}
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
                                     {{$driver->company->email}}
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
                                       {{$driver->company->phone}}
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
                                                  href="{{asset($driver->company->trade_license)}}"
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
        <div class="row gx-6 gx-xl-9">
            <div class="col-lg-6">
            <div class="card card-flush h-lg-100">
                <div class="card-body">
                    <div
                        class="d-flex flex-wrap flex-sm-nowrap"
                    >
                        <!--begin::Image-->
                        <div class="d-flex flex-center flex-shrink-0 bg-light rounded w-100px h-100px w-lg-125px h-lg-125px me-7 mb-4">
                            @if($driver->profile)
                                <img class="mw-50px mw-lg-75px" src="{{ asset($driver->profile) }}" alt="image" />
                            @else
                                <div class="text-center d-flex align-items-center justify-content-center w-100 h-100">
                                    <h1>{{ strtoupper(substr($driver->name ?? 'A', 0, 1)) }}</h1>
                                </div>
                            @endif
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
                                            {{$driver->name}}
                                        </h3>
                                        <span
                                            class="badge badge-light-success me-auto"
                                            >Driver
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
                                            {{$driver->address}}
                                        </div>
                                    </div>
                                    <!--end::Description-->
                                    <div
                                        class="d-flex align-items-center gap-4"
                                    >
                                        <div
                                            class="d-flex align-items-center mb-4 gap-2"
                                        >
                                            <i
                                                class="las la-calendar-day fs-2x"
                                            ></i>
                                            <div
                                                class="d-flex flex-wrap fw-semibold fs-5 text-gray-500"
                                            >
                                                {{ \Carbon\Carbon::parse($driver->dob)->format('d M Y') }}

                                            </div>
                                        </div>
                                        <div
                                            class="d-flex align-items-center mb-4"
                                        >
                                            <i
                                                class="ki-duotone ki-star fs-2x me-2 text-warning"
                                            >
                                            </i>
                                            <div
                                                class="d-flex flex-wrap fw-semibold fs-5 text-gray-500"
                                            >
                                                    {{$driver->ratting}}
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="d-flex align-items-center gap-2"
                                    >
                                        <div
                                            class="d-flex align-items-center mb-4"
                                        >
                                            <i
                                                class="las la-envelope fs-2x me-2"
                                            >
                                            </i>
                                            <div
                                                class="d-flex flex-wrap fw-semibold fs-5 text-gray-500"
                                            >
                                                    {{$driver->email}}
                                            </div>
                                        </div>
                                        <div
                                            class="d-flex align-items-center mb-4"
                                        >
                                            <i
                                                class="las la-phone fs-2x me-2"
                                            >
                                            </i>
                                            <div
                                                class="d-flex flex-wrap fw-semibold fs-5 text-gray-500"
                                            >
                                                +88{{$driver->phone}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Details-->
                            </div>
                            <!--end::Head-->
                        </div>
                        <!--end::Wrapper-->
                    </div>

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
                                class="d-flex align-items-center border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6"
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
                                    <h3
                                        class="fs-6 fw-bold text-gray-900 text-hover-primary"
                                    >
                                        Driving
                                        License
                                    </h3>

                                    <div
                                        class="text-gray-500 d-flex gap-3"
                                    >
                                        <a target="_blank" href="{{asset($driver->driving_licence_font_image)}}"
                                            >Front
                                            View</a
                                        >
                                        <a target="_blank" href="{{asset($driver->driving_licence_back_image)}}"
                                            >Back
                                            View</a
                                        >
                                    </div>
                                </div>
                            </div>
                            <div
                                class="d-flex align-items-center border border-gray-300 border-dashed rounded py-3 px-4 me-6"
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
                                    <h3
                                        class="fs-6 fw-bold text-gray-900 text-hover-primary"
                                    >
                                        RTA Card
                                    </h3>

                                    <div
                                        class="text-gray-500 d-flex gap-3"
                                    >
                                        <a
                                            href="{{asset($driver->rta_card_font_image)}}"
                                            target="_blank"
                                            >Front
                                            View</a
                                        >
                                        <a
                                            href="{{asset($driver->rta_card_font_image)}}"
                                            target="_blank"
                                            >Back
                                            View</a
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Info-->
                </div>
            </div>
            </div>
            @if(!empty($driver->car))
            <div class="col-lg-6">
            <div class="card card-flush h-lg-100">
                <div class="card-body">
                    <div
                        class="d-flex flex-wrap flex-sm-nowrap"
                    >
                        <!--begin::Image-->
                        <div
                            class="d-flex flex-center flex-shrink-0 bg-light rounded w-100px h-100px me-7 mb-4"
                        >
                            <img
                                class="mw-50px mw-lg-75px"
                                src="{{asset($driver->car->car_image)}}"
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
                                            {{$driver->car->car_name}}
                                        </h3>
                                        <span
                                            class="badge badge-light-success me-auto"
                                            >Car
                                            Information</span
                                        >
                                    </div>
                                    <!--end::Status-->
                                    <div
                                        class="d-flex align-items-center gap-4"
                                    >
                                        <div
                                            class="d-flex align-items-center mb-4 gap-2"
                                        >
                                            <i
                                                class="las la-car fs-2x"
                                            ></i>
                                            <div
                                                class="d-flex flex-wrap fw-semibold fs-5 text-gray-500"
                                            >
                                                {{$driver->car->car_model}}
                                            </div>
                                        </div>
                                        <div
                                            class="d-flex align-items-center mb-4 gap-2"
                                        >
                                            <i
                                                class="lar la-user fs-2x"
                                            ></i>
                                            <div
                                                class="d-flex flex-wrap fw-semibold fs-5 text-gray-500"
                                            >
                                                {{$driver->car->passengers}}
                                            </div>
                                        </div>
                                        <div
                                            class="d-flex align-items-center mb-4 gap-2"
                                        >
                                            <i
                                                class="las la-briefcase fs-2x"
                                            ></i>
                                            <div
                                                class="d-flex flex-wrap fw-semibold fs-5 text-gray-500"
                                            >
                                                {{$driver->car->car_bag}}
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="d-flex flex-wrap justify-content-start"
                                    >
                                        <!--begin::Stats-->
                                        <div
                                            class="d-flex flex-wrap"
                                        >
                                            <!--begin::Stat-->
                                            <div
                                                class="border border-gray-300 border-dashed rounded py-3 px-4 me-3 mb-3"
                                            >
                                                <!--begin::Number-->
                                                <div
                                                    class="d-flex align-items-center"
                                                >
                                                    <div
                                                        class="fs-4 fw-bold"
                                                    >
                                                        Car
                                                        Make
                                                    </div>
                                                </div>
                                                <!--end::Number-->

                                                <!--begin::Label-->
                                                <div
                                                    class="fw-semibold fs-6 text-gray-500"
                                                >
                                                        {{$driver->car->car_make}}
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <div
                                                class="border border-gray-300 border-dashed rounded py-3 px-4 me-3 mb-3"
                                            >
                                                <!--begin::Number-->
                                                <div
                                                    class="d-flex align-items-center"
                                                >
                                                    <div
                                                        class="fs-4 fw-bold"
                                                    >
                                                        Car
                                                        Color
                                                    </div>
                                                </div>
                                                <!--end::Number-->

                                                <!--begin::Label-->
                                                <div
                                                    class="fw-semibold fs-6 text-gray-500"
                                                >
                                                        {{$driver->car->car_color}}
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <div
                                                class="border border-gray-300 border-dashed rounded py-3 px-4 me-3 mb-3"
                                            >
                                                <!--begin::Number-->
                                                <div
                                                    class="d-flex align-items-center"
                                                >
                                                    <div
                                                        class="fs-4 fw-bold"
                                                    >
                                                        Car
                                                        Base
                                                    </div>
                                                </div>
                                                <!--end::Number-->

                                                <!--begin::Label-->
                                                <div
                                                    class="fw-semibold fs-6 text-gray-500"
                                                >
                                                        {{$driver->car->car_base}}
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <div
                                                class="border border-gray-300 border-dashed rounded py-3 px-4 me-3 mb-3"
                                            >
                                                <!--begin::Number-->
                                                <div
                                                    class="d-flex align-items-center"
                                                >
                                                    <div
                                                        class="fs-4 fw-bold"
                                                    >
                                                        Year
                                                    </div>
                                                </div>
                                                <!--end::Number-->

                                                <!--begin::Label-->
                                                <div
                                                    class="fw-semibold fs-6 text-gray-500"
                                                >
                                                        {{$driver->car->year}}
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Details-->
                            </div>
                            <!--end::Head-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <div>
                        <!--begin::Stats-->
                        <div
                            class="d-flex flex-wrap"
                        >
                            <div
                                class="d-flex align-items-center w-100 border border-gray-300 border-dashed rounded py-3 px-4 me-3"
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
                                    <h3
                                        class="fs-6 fw-bold text-gray-900 text-hover-primary"
                                    >
                                        Car Register
                                        Card
                                    </h3>

                                    <div
                                        class="text-gray-500 d-flex gap-3"
                                    >
                                        <a
                                            href="{{asset($driver->car->car_register_card)}}"
                                            target="_blank"
                                            >Car
                                            Register
                                            Card
                                            View</a
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            @endif
        </div>

        <div class="card card-flush mt-5">
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
                        <th>Passenger Name</th>
                        <th>Passenger Phone</th>
                        <th>Origin Address</th>
                        <th>Destination Address</th>
                        <th>Pick Time</th>
                        <th>Drop Time</th>
                        <th>Income Fare</th>
                        <th>Trip Type</th>
                    </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                    @foreach($trip  as $key=>$tripData)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                @if($tripData->passenger_id==null)
                                    {{$tripData->passenger_name}}
                                @else
                                   {{$tripData->passenger->name}}
                                @endif
                            </td>
                            <td>
                               @if($tripData->passenger_id==null)
                                    {{$tripData->passenger_phone}}
                               @else
                                   {{$tripData->passenger->phone}}
                               @endif
                            </td>
                            <td>{{$tripData->origin_address}}</td>
                            <td>{{$tripData->destination_address}}</td>
                            <td>{{$tripData->pick_time? $tripData->pick_time:'N/A'}}</td>
                            <td>{{$tripData->drop_time? $tripData->drop_time:'N/A'}}</td>
                            <td>
                                @if($tripData->fare_received_status==0)
                                    {{$tripData->calculated_fare}}
                                @elseif($tripData->fare_received_status==1)
                                    {{$tripData->estimated_fare}}
                                @endif
                            </td>
                            <td>
                                @if($tripData->trip_type=='request_trip')
                                    <p class="text-info">Request Trip</p>
                                @elseif($tripData->trip_type=='manual_trip')
                                    <p class="text-success">Manual Trip</p>

                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
               {{ $trip->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection