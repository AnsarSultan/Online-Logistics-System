@extends('adminLayout')
@section('content')
    <div class="income container">
        <h3>Edit Freight Details</h3>
        <form method="POST" action="{{ route('update.freight', ['id' => $freight->freightID]) }}">
            @csrf
            <div class="mb-3">
                <label for="currentLocation" class="form-label">Current Location</label>
                <input type="text" name="currentLocation" class="form-control" id="currentLocation"
                    value="{{ old('currentLocation', $freight->currentLocation) }}" required>
            </div>

            <div class="mb-3">
                <label for="currentStatus" class="form-label">Freight Status</label>
              
                    <select name="freightStatus" id="currentStatus" class="form-select" required>
                        @foreach ($status as $stat)
                            @continue($stat->id < $freight->freightStatus)    
                            <option value="{{ $stat->id }}" {{ $freight->freightStatus == $stat->id ? 'selected' : '' }}>
                                {{ $stat->status }}
                            </option>
                        @endforeach
                    </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Freight</button>
        </form>
    </div>
@endsection
