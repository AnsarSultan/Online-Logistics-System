@extends('adminLayout')
@section('content')
    <div class="freights container-fluid mx-1">
        <h5 class="freight-heading">Manage freights</h5>
        <div class="col-md-5 my-2">
            <label for="status" class="form-label">View Freights by Freight Status*</label>
            <select id="status" name="status" class="form-select" required>
                <option value="0" selected>All Freights</option>
                @foreach ($status as $status)
                    <option value="{{ $status->id }}">{{ $status->status }}</option>
                @endforeach
            </select>
        </div>
        <hr>
        <div class="freights-list">
            <h6 class="freight-heading" id="freight-heading">All Freights</h6>
            <table class="table table-bordered" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">Freight ID</th>
                        <th scope="col">User Id</th>
                        <th scope="col">Origin</th>
                        <th scope="col">Destination</th>
                        <th scope="col">Weight</th>
                        <th scope="col">Charges</th>
                        <th scope="col">Freight Date</th>
                        <th scope="col">Freight Status</th>
                        <th scope="col">Current Location</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($freights->isEmpty())
                        <tr>
                            <td colspan="10">No freight records found</td>
                        </tr>
                    @else
                        @foreach ($freights as $freight)
                            <tr>
                                <td>{{ $freight->freightID }}</td>
                                <td>{{ $freight->user_name }}</td>
                                <td>{{ $freight->origin }}</td>
                                <td>{{ $freight->destination }}</td>
                                <td>{{ $freight->weight }}</td>
                                <td>{{ $freight->charges }}</td>
                                <td>{{ $freight->freightDate }}</td>
                                <td>{{ $freight->freight_status }}</td>
                                <td>{{ $freight->currentLocation }}</td>
                                @if ($freight->freightStatus == '4')
                                <td>N/A</td>
                                @else
                                   <td><a class="btn btn-warning btn-sm" href="{{ route('edit.freight', ['id' => $freight->freightID]) }}">Edit</a></td>
                                @endif
                               
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#status').change(function() {
                var statusId = $(this).val();
                
                var selectedStatusText = $('#status option:selected').text();
                $('#freight-heading').text(selectedStatusText);
                
                $.ajax({
                    url: statusId == 0 ? "{{ route('freights.all') }}" :
                        "{{ route('freights.byStatus', '') }}/" + statusId,
                    method: 'GET',
                    success: function(data) {
                        var tableBody = $('#myTable tbody');
                        tableBody.empty(); 

                        if (data.length > 0) {
                            $.each(data, function(index, freight) {
                                tableBody.append('<tr>' +
                                    '<td>' + freight.freightID + '</td>' +
                                    '<td>' + freight.user_name + '</td>' +
                                    '<td>' + freight.origin + '</td>' +
                                    '<td>' + freight.destination + '</td>' +
                                    '<td>' + freight.weight + '</td>' +
                                    '<td>' + freight.charges + '</td>' +
                                    '<td>' + freight.freightDate + '</td>' +
                                    '<td>' + freight.freight_status + '</td>' +
                                    '<td>' + freight.currentLocation + '</td>' +
                                    '<td><a class="btn btn-warning btn-sm" href="/edit-freight/' + freight.freightID + '">Edit</a></td>' +
                                    '</tr>');
                            });
                        } else {
                            tableBody.append(
                                '<tr><td colspan="10">No freights record found</td></tr>');
                        }
                    }
                });
            });
        });
    </script>
@endsection
