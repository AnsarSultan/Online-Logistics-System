<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Logistic System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/style.css') }}">
</head>

<body>
    @include('adminHeader')
    <div class="admin-home">
        @include('adminSideBar')
        <div class="freights">
            <h2 class="freight-heading">Manage freights</h2>
            <a class="btn btn-primary btn-sm ms-3" href="{{route('admin.panel')}}">Pending freights</a>
            <a class="btn btn-primary btn-sm ms-3" href="{{route('delivered.freights')}}">Delivered freights</a>
            <hr>
            <div class="pending-freights">
                <h2 class="freight-heading">Delivered Freights</h2>
                <table class="table text-center">
                    <tr>
                        <th scope="col">freight ID</th>
                        <th scope="col">User Id</th>
                        <th scope="col">Origin</th>
                        <th scope="col">Destination</th>
                        <th scope="col">Weight</th>
                        <th scope="col">Charges</th>
                        <th scope="col">Freight Date</th>
                        <th scope="col">Freight Status</th>
                        <th scope="col">Current Location</th>
                        <th>action</th>
                    </tr>
                    @if ($freights->isEmpty())
                        <tr>
                            <td colspan="5">No record found</td>
                        </tr>
                    @else
                        @foreach ($freights as $freight)
                            <tr>
                                <td>{{ $freight->freightID }}</td>
                                <td>{{ $freight->userID }}</td>
                                <td>{{ $freight->origin }}</td>
                                <td>{{ $freight->destination }}</td>
                                <td>{{ $freight->weight }}</td>
                                <td>{{ $freight->charges }}</td>
                                <td>{{ $freight->freightDate }}</td>
                                <td>{{ $freight->freightStatus }}</td>
                                <td>{{ $freight->currentLocation }}</td>
                                <td><a class="edit-btn" href="{{ route('edit.freight', ['id' => $freight->freightID]) }}">Edit</a></td>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </table> 
            </div>
        </div>
    </div>
</body>

</html>
