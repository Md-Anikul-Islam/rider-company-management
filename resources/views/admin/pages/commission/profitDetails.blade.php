@extends('admin.layout') @section('admin_content') <div class="toolbar" id="kt_toolbar">
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center me-3 flex-wrap lh-1">
            <h1 class="d-flex align-items-center text-dark fw-bold my-1 fs-3"> Admin</h1>
            <span class="h-20px border-gray-200 border-start mx-4"></span>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-1">
                <li class="breadcrumb-item text-muted">
                    <a href="#" class="text-muted text-hover-primary">Profit History</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="post d-flex flex-column-fluid mb-5" id="kt_post">
    <div id="kt_content_container" class="container-fluid">
        <div class="card card-flush">
            <div class="card-body pt-0"> @if(isset($company)) <table class="table align-middle table-row-dashed fs-6 gy-5" id="">
                    <div class="company_wise_income">
                        <h3>Company: {{ $company->name }}</h3>
                        <div class="d-flex align-items-center justify-content-between mb-5 gap-5">
                            <div class="income_details">
                                <p class="total_income">Total Earnings: {{ $totalEarnings }}</p>
                                <p class="commission">Commission Rate: {{ $commissionRate }}%</p>
                                <p class="admin_income">Admin Earnings: {{ $adminEarnings }}</p>
                            </div>
                            <div>
                                <form class="filter_area" method="GET" action="{{ route('admin.earning.profit', $company->id) }}">
                                    <div class="d-flex align-items-end gap-5">
                                        <div>
                                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2 required">Filter</label>
                                            <select name="filter" class="form-select form-select-solid w-200px" required>
                                                <option value="">Select Period</option>
                                                <option value="today" {{ request('filter') == 'today' ? 'selected' : '' }}>Today Income</option>
                                                <option value="weekly" {{ request('filter') == 'weekly' ? 'selected' : '' }}>Weekly Income</option>
                                                <option value="monthly" {{ request('filter') == 'monthly' ? 'selected' : '' }}>Monthly Income</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-3">Apply Filter</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <thead>
                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                            <th>S/N</th>
                            <th>Driver Name</th>
                            <th>Origin Address</th>
                            <th>Destination Address</th>
                            <th>Date</th>
                            <th>Income Fare</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600"> @foreach($trips as $key=>$trip) <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$trip->driver->name}}</td>
                            <td> {{$trip->origin_address}}</td>
                            <td> {{$trip->destination_address}}</td>
                            <td> {{ \Carbon\Carbon::parse($trip->created_at)->format('d M Y') }} </td>
                            <td> @if($trip->fare_received_status==0) {{$trip->calculated_fare}} @elseif($trip->fare_received_status==1) {{$trip->estimated_fare}} @endif </td>
                        </tr> @endforeach <tr>
                            <td colspan="8" class="text-end fw-bold">Total Income:</td>
                            <td colspan="2" class="fw-bold">{{ number_format($totalEarnings, 2) }}</td>
                        </tr>
                    </tbody>
                </table> @endif </div>
        </div>
    </div>
</div> @endsection