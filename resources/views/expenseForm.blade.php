@extends('adminLayout')
@section('content')
    <div class="expenses">
        <div class="add-expense-form-container">
            <form class="row g-3 add-expense-form" method="POST" action="{{ $expense ? route('update.expense', $expense->id) : route('store.expense') }}">
                @csrf
                @if($expense)
                   @method('PUT') 
                @endif
                <div class="col-md-12 text-center">
                    <h3 class="title">{{ $expense ? 'Update Expense' : 'Add Expense'}}</h3>
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
                    <label for="expensetype" class="form-label">Expense Type</label>
                    <input type="text" class="form-control" value="{{ old('type' , $expense->type ?? '' )  }}" name="expensetype"
                        id="expensetype">
                </div>
                <div class="col-md-6">
                    <label for="expenseamount" class="form-label">Expense amount</label>
                    <input type="number" class="form-control" value="{{ old('amount' , $expense->amount ?? '' )}}" name="expenseamount"
                        id="expenseamount">
                </div>
                <div class="col-12">
                    <label for="expensedate" class="form-label">Expense Date</label>
                    <input type="date" class="form-control" value="{{ old('date' , $expense->date  ?? '' )}}" name="expensedate"
                        id="expensedate">   
                </div>
                <div class="col-12 text-center">
                    <a href="{{ route('manage.expense') }}" class="admin-back-btn">Back</a>
                    <input type="submit" name="addExpense" class="admin-back-btn"
                     value="{{ $expense ? 'Update details' : 'Add Expense' }}">
                </div>
            </form>
        </div>
    </div>
@endsection
