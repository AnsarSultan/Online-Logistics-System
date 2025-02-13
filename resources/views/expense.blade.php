@extends('adminLayout')
@section('content')
    <div class="expenses mx-3">
        <h2 class="freight-heading">Manage Expense</h2>
        <a class="btn btn-success btn-sm ms-3" href="{{ route('add.expense') }}">Add expense</a>
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
            @if ($expenses->isEmpty())
                <tr>
                    <td colspan="5">No expense record found</td>
                </tr>
            @else
                @foreach ($expenses as $expense)
                    <tr>
                        <td>{{ $expense->id }}</td>
                        <td>{{ $expense->type }}</td>
                        <td>{{ $expense->amount }}</td>
                        <td>{{ $expense->date }}</td>
                        <td>
                            <a class="btn btn-warning btn-sm" href="{{ route('edit.expense', $expense->id) }}">Edit</a>
                            <form action="{{ route('delete.expense', $expense->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm onclick="
                                  onclick="return confirm('Are you sure you want to delete this expense?');" >Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
@endsection
