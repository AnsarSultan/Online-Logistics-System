@extends('adminLayout')
@section('content')
    <div class="driver mx-3">
        <h2 class="freight-heading">Manage Vehicle</h2>
        <a class="btn btn-success btn-sm ms-3" href="{{ route('add.vehicle') }}">Add vehicle</a>
        <hr>
        <table class="table table-bordered mx-auto w-100" id="myTable">
            <thead>
                <tr>
                    <th scope="col">Vehicle ID</th>
                    <th scope="col">Registration number</th>
                    <th scope="col">Company Name</th>
                    <th scope="col">Model</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                @if ($vehicles->isEmpty())
                    <tr>
                        <td colspan="5">No vehicles found</td>
                    </tr>
                @else
                    @foreach ($vehicles as $vehicle)
                        <tr>
                            <td>{{ $vehicle->id }}</td>
                            <td>{{ $vehicle->regNumber }}</td>
                            <td>{{ $vehicle->model }}</td>
                            <td>{{ $vehicle->companyName }}</td>
                            <td>
                                <a class="btn btn-warning btn-sm"
                                    href="{{ route('update.vehicle', $vehicle->id) }}">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            <tbody>
        </table>
    </div>
@endsection
