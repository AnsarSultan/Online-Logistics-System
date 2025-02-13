@extends('adminLayout')
@section('content')
    <div class="trips">
        <form class="row g-3 add-trips-form" method="POST" action="{{ $trip ? route('trips.update', $trip->id) : route('store.trip') }}">
            @csrf
            @if ($trip)
                @method('PUT')
            @endif
            <div class="col-md-12 text-center">
                <h3 class="title">{{ $trip ? 'Edit Trip' : 'Add Trip'}}</h3>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-md-5">
                <label for="vehicleID" class="form-label">Select Vehicle by RegNumber:</label>
                <select id="vehicleID" name="vehicleID" class="form-select" required>
                    <option disabled selected>Select Vehicle</option>
                    @foreach ($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}"
                            {{ old('origin', $trip->vehicleID ?? '') == $vehicle->id ? 'selected' : '' }}>
                            {{ $vehicle->regNumber }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-5">
                <label for="driverID" class="form-label">Select Driver by ID:</label>
                <select id="inputState2" name="driverID" class="form-select" required>
                    <option disabled selected>Select driver</option>
                    @foreach ($drivers as $driver)
                        <option value="{{ $driver->id }}"
                            {{ old('origin', $trip->driverID ?? '') == $driver->id ? 'selected' : '' }}>
                            {{ $driver->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-6">
                <label for="startingpoint" class="form-label">Enter Origin Address</label>
                <input type="text" class="form-control" name="startingpoint" id="startingpoint"
                    value="{{ old('startingPoint', $trip->startingPoint ?? '') }}">
            </div>
            <div class="col-6">
                <label for="destination" class="form-label">Enter Destination Address:</label>
                <input type="text" class="form-control" name="destination" id="destination"
                    value="{{ old('destination', $trip->destination ?? '' ) }}">
            </div>
            <div class="col-md-6">
                <label for="distancecovered" class="form-label">Enter distance covered in KM:</label>
                <input type="number" class="form-control" name="distancecovered" id="distancecovered"
                    value="{{ old('distanceCovered' , $trip->distanceCovered ?? '') }}">
            </div>
            <div class="col-md-6">
                <label for="charges" class="form-label">Total charges:</label>
                <input type="number" name="charges" class="form-control" id="charges" value="{{ old('charges', $trip->charges ?? '' ) }}">
            </div>
            <div class="col-12 text-center">
                <a href="{{ route('manage.trips') }}" class="admin-back-btn">Back</a>
                <input type="submit" class="admin-back-btn" value="{{ $trip ? 'Update Trip' : 'Add Trip'}}">
            </div>
        </form>
    </div>
@endsection
