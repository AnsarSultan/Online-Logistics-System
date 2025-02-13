@extends('adminLayout')
@section('content')
    <div class="expenses">
        <div class="add-expense-form-container">
            <form class="row g-3 add-expense-form" method="POST"
                action="{{ $driver ? route('update.driver', $driver->id) : route('store.driver') }}">
                @csrf
                @if ($driver)
                    @method('PUT')
                @endif
                <div class="col-md-12 text-center">
                    <h3 class="title">{{ $driver ? 'Edit Driver' : 'Add Driver' }}</h3>
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
                    <label for="drivername" class="form-label">Enter Driver's name</label>
                    <input type="text" class="form-control" value="{{ old('name' , $driver->name ?? '' )  }}"
                        name="drivername" id="drivername">
                </div>
                <div class="col-md-6">
                    <label for="driverLicense" class="form-label">Enter Driver's License number</label>
                    <input type="number" class="form-control"
                        value="{{ old('licenseNumber', $driver->licenseNumber ?? '' ) }}" name="driverLicense"
                        id="driverLicense">
                </div>

                <div class="col-12">
                    <label for="driverNumber" class="form-label">Enter Driver's Phone Number</label>
                    <input type="tel" class="form-control" value="{{ old('phoneNumber', $driver->phoneNumber ?? '' ) }}"
                        name="driverNumber" id="driverNumber">
                </div>
                <div class="col-12 text-center">
                    <a href="{{ route('manage.driver') }}" class="admin-back-btn">Back</a>
                    <input type="submit" name="addDriver" class="admin-back-btn"
                        value="{{ $driver ? 'Update details' : 'Add driver' }}">
                </div>
            </form>
        </div>
    </div>
@endsection
