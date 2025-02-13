@extends('adminLayout')
@section('content')
    <div class="income mx-3">
        <h2 class="freight-heading">Manage Income</h2>
        <a class="btn btn-success btn-sm ms-3" href="{{ route('add.income') }}">Add income</a>
        <hr>
        <table class="table table-bordered mx-auto w-100"  id="myTable">
            <thead>
            <tr>
                <th scope="col">Expense ID</th>
                <th scope="col">Expense type</th>
                <th scope="col">Amount</th>
                <th scope="col">Date</th>
                <th>action</th>
            </tr>
            </thead>
            <tbody>
            @if ($incomes->isEmpty())
                <tr>
                    <td colspan="5">No income record found</td>
                </tr>
            @else
                @foreach ($incomes as $income)
                    <tr>
                        <td>{{ $income->id }}</td>
                        <td>{{ $income->source }}</td>
                        <td>{{ $income->amount }}</td>
                        <td>{{ $income->date }}</td>
                        <td>
                            <a class="btn btn-warning btn-sm" href="{{ route('edit.income', $income->id) }}">Edit</a>
                            <form action="{{ route('delete.income', $income->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this income?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
@endsection
