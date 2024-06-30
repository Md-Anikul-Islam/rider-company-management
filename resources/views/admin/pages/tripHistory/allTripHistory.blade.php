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
                        <a href="#" class="text-muted text-hover-primary">All Trip History</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

        <div class="post d-flex flex-column-fluid mb-5" id="kt_post">
            <div id="kt_content_container" class="container-fluid">
                <div class="card card-flush">
                    <div class="card-body pt-0">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="">

                            <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                <th>S/N</th>
                                <th>Company Name</th>
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
                                  <td>{{$tripData->company->name}}</td>
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
                    </div>
                </div>
            </div>
        </div>



@endsection
