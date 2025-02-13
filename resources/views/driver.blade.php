@extends('adminLayout')
@section('content')
    <div class="driver mx-3">
        <h2 class="freight-heading">Manage driver's Data</h2>
        <a class="btn btn-success btn-sm ms-3" href="{{ route('add.driver') }}">Add driver</a>
        <hr>
        <table class="table table-bordered mx-auto w-100" id="myTable">
            <thead>
                <tr>
                    <th scope="col">Driver ID</th>
                    <th scope="col">Driver Name</th>
                    <th scope="col">License Number</th>
                    <th scope="col">Phone Number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($drivers->isEmpty())
                    <tr>
                        <td colspan="5">No driver record found</td>
                    </tr>
                @else
                    <tr>
                        @foreach ($drivers as $driver)
                            <td>{{ $driver->id }}</td>
                            <td>{{ $driver->name }}</td>
                            <td>{{ $driver->licenseNumber }}</td>
                            <td>{{ $driver->phoneNumber }}</td>
                            <td>
                                <a class="btn btn-warning btn-sm" href="{{ route('edit.driver', $driver->id) }}">Edit</a>

                            </td>
                        @endforeach
                    </tr>
                @endif  
            </tbody>
        </table>
    </div>
@endsection
