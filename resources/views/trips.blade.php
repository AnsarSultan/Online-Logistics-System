@extends('adminLayout')
@section('content')
<div class="trips mx-3">
    <h2 class="freight-heading">Manage Trips</h2>
    <a class="btn btn-success btn-sm ms-3" href="{{route('add.trip')}}">Add trip</a>
    <hr>
    <table class="table table-bordered mx-auto w-auto" id="myTable">
        <thead>
        <tr>
            <th scope="col">Vehicle ID</th>
            <th scope="col">Driver name</th>
            <th scope="col">Starting Point</th>
            <th scope="col">Destination</th>
            <th scope="col">Distance Covered</th>
            <th scope="col">Charges</th>
            <th>action</th>
        </tr>
    </thead>
    <tbody>
        @if ($trips->isEmpty())
            <tr>
                <td colspan="7">No Trip found</td>
            </tr>
        @else
            @foreach ($trips as $trip)
                <tr>
                    <td>{{ $trip->vehicle_reg_number }}</td>
                    <td>{{ $trip->driver_name }}</td>
                    <td>{{ $trip->startingPoint }}</td>
                    <td>{{ $trip->destination }}</td>
                    <td>{{ $trip->distanceCovered }}</td>
                    <td>{{ $trip->charges }}</td>
                    <td>
                        <a class="btn btn-warning btn-sm" href="{{ route('trips.edit', $trip->trip_id) }}">Edit</a>
                    </td>
                </tr>
            </tbody>
            @endforeach
        @endif
    </table>     
</div>
@endsection