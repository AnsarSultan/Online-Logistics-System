@extends('adminLayout')
@section('content')
    <div class="trips">
        <h1 class="freight-heading">{{ $rate ? 'Edit Location' : 'Add Location' }}</h1>
        <a class="btn btn-success btn-sm ms-3" href="{{ route('locations') }}">Back</a>
        <hr>
        <div class="container w-50">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ $rate ? route('locations.update', $rate->id) : route('locations.store') }}" method="POST">
                @csrf
                @if ($rate)
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="origin">Origin</label>
                    <select class="form-control" id="origin" name="origin" required>
                        <option value="" disabled selected>Select Origin</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}"
                                {{ old('origin', $rate->origin ?? '') == $city->id ? 'selected' : '' }}>
                                {{ $city->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="destination">Destination</label>
                    <select class="form-control" id="destination" name="destination" required>
                        <option value="" disabled selected>Select Destination</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}"
                                {{ old('destination', $rate->destination ?? '') == $city->id ? 'selected' : '' }}>
                                {{ $city->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="rate">Rate</label>
                    <input type="number" class="form-control" id="rate" name="rate"
                        value="{{ old('rate', $rate->rate ?? '') }}" required>
                </div>
                <div class="form-group">
                    <label for="isActive">Active</label>
                    <select class="form-control" id="isActive" name="isActive" required>
                        <option value="1"
                            {{ (isset($rate) && $rate->isActive) || old('isActive') == '1' ? 'selected' : '' }}>Yes
                        </option>
                        <option value="0"
                            {{ (isset($rate) && !$rate->isActive) || old('isActive') == '0' ? 'selected' : '' }}>No
                        </option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mt-2">{{ $rate ? 'Update' : 'Add' }}</button>
            </form>
        </div>
    </div>
@endsection
