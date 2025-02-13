@extends('userLayout')
@section('content')
    <div class="shipment">
        <h2>Enter Your Freight ID:</h2>
        <form action="{{ route('track.Shipment') }}" method="post">
            @csrf
            <input id="track-shipment" name="freightID" type="text">
            <input id="track-shipment-btn" type="submit" name='search' value="Search">
        </form>

        @if (isset($shipment))
            @if ($shipment === 1)
                <h6 class="text-danger" style="color: red;">Record not found</h6>
            @else
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="row1">Freight ID</div>
                            <div class="row2">{{ $shipment->freightID }}</div>
                        </div>
                        <div class="col">
                            <div class="row1">Start Location</div>
                            <div class="row2">{{ $shipment->origin }}</div>
                        </div>
                        <div class="col">
                            <div class="row1">Destination</div>
                            <div class="row2">{{ $shipment->destination }}</div>
                        </div>
                        <div class="col">
                            <div class="row1">Current Location</div>
                            <div class="row2">{{ $shipment->currentLocation }}</div>
                        </div>
                        <div class="col">
                            <div class="row1">Shipment Status</div>
                            <div class="row2">{{ $shipment->freight_status }}</div>
                        </div>
                        <div class="col">
                            <div class="row1">Shipment Date</div>
                            <div class="row2">{{ $shipment->freightDate }}</div>
                        </div>
                        <div class="col">
                            <div class="row1">Estimated Arrival Date</div>
                            <div class="row2">{{ $shipment->estimatedArrivalDate }}</div>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>
    @endsection
