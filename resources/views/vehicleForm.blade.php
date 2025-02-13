@extends('adminLayout')
@section('content')
    <div class="expenses">
        <div class="add-expense-form-container">
            <form class="row g-3 add-expense-form" method="POST"
                action="{{ $vehicle ? route('update.vehicle', $vehicle->id) : route('add.vehicle') }}">
                @csrf
                @if ($vehicle)
                    @method('PUT')
                @endif
                <div class="col-md-12 text-center">
                    <h3 class="title">{{ $vehicle ? 'Update Vehicle' : 'Add Vehicle'}}</h3>
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
                <div class="col-md-6">
                    <label for="vehicleregistration" class="form-label">Enter Vehicle Registration Number:</label>
                    <input type="number" name="vehicleregistration" value="{{ old('regNumber', $vehicle->regNumber ?? '') }}" class="form-control"
                        id="vehicleregistration">
                </div>
                <div class="col-md-6">
                    <label for="vehiclemodel" class="form-label">Enter Vehicle Model:</label>
                    <input type="number" class="form-control" value="{{ old('model', $vehicle->model ?? '') }}" name="vehiclemodel"
                        id="vehiclemodel">
                </div>
                <div class="col-6">
                   
                    <label for="companyName" class="form-label">Enter Vehicle Company Name:</label>
                    <input type="text" class="form-control" value="{{ old('companyName', $vehicle->companyName ?? '') }}" name="companyName"
                        id="companyName">
                </div>
                <div class="col-12 text-center">
                    <a href="{{ route('manage.vehicle') }}" class="admin-back-btn">Back</a>
                    <input type="submit" name="addVehicle" class="admin-back-btn" value="{{ $vehicle ? 'Update Details' : 'Add Vehicle'}}">
                </div>
            </form>
        </div>
    </div>
@endsection
