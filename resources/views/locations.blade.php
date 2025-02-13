@extends('adminLayout')
@section('content')
    <div class="trips">
        <h2 class="freight-heading">Manage cites and rates</h2>
        <a class="btn btn-success btn-sm ms-3" href="{{ route('locations.create') }}">Add Locations</a>
        <hr>
        <table class="table  table-bordered w-75 mx-auto">
            <thead>
                <tr>
                    <th>Origin</th>
                    <th>Destination</th>
                    <th>Rate</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rates as $rate)
                    <tr>
                        <td>{{ $rate->origin_name }}</td>
                        <td>{{ $rate->destination_name }}</td>
                        <td>{{ $rate->rate }}</td>
                        <td>{{ $rate->isActive ? 'Yes' : 'No' }}</td>
                        <td>
                            <a class="btn btn-warning btn-sm" href="{{ route('locations.edit', $rate->id) }}">Edit</a>
                            <form action="{{ route('locations.destroy', $rate->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this location?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
