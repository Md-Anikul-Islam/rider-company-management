@extends('admin.layout')
@section('admin_content')
    <div class="container">
        <h2>Select Company</h2>
        <form action="{{ route('admin.earning.company.commission') }}" method="get">
            @csrf
            <div class="form-group">
                <label for="company_id">Company</label>
                <select name="company_id" id="company_id" class="form-control">
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Get Commission</button>
        </form>

        @if(isset($company))
            <h3>Company: {{ $company->name }}</h3>
            <p>Total Earnings: {{ $totalEarnings }}</p>
            <p>Commission Rate: {{ $commissionRate }}%</p>
            <p>Admin Earnings: {{ $adminEarnings }}</p>

            <h4>Trip History</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>Trip ID</th>
                        <th>Passenger Name</th>
                        <th>Driver Name</th>
                        <th>Income Fare</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($trips as $trip)
                        <tr>
                            <td>{{ $trip->id }}</td>
                            <td>
                              @if($trip->passenger_id==null)
                                  {{$trip->passenger_name}}
                              @else
                                 {{$trip->passenger->name}}
                              @endif
                            </td>
                            <td>
                               {{$trip->driver->name}}
                            <td>
                              @if($trip->fare_received_status==0)
                                  {{$trip->calculated_fare}}
                              @elseif($trip->fare_received_status==1)
                                  {{$trip->estimated_fare}}
                              @endif
                             </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
