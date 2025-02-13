@extends('adminLayout')
@section('content')
    <div class="expenses">
        <div class="add-expense-form-container">
            <form class="row g-3 add-expense-form" method="POST"
                action="{{ $income ? route('update.income', $income->id) : route('store.income') }}">
                @csrf
                @if ($income)
                    @method('PUT')
                @endif
                <div class="col-md-12 text-center">
                    <h3 class="title">{{ $income ? 'Update Income' : 'Add Income' }}</h3>
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
                    <label for="incomesource" class="form-label">Enter income's Source</label>
                    <input type="text" class="form-control" value="{{ old('source' , $income->source ?? '') }}" name="incomesource"
                        id="incomesource">
                </div>
                <div class="col-md-6">
                    <label for="incomeamount" class="form-label">Income amount</label>
                    <input type="number" class="form-control" value="{{ old('amount' , $income->amount ?? '') }}" name="incomeamount"
                        id="incomeamount">
                </div>
                <div class="col-12">
                    <label for="incomedate" class="form-label">Expense Date</label>
                    <input type="date" class="form-control" value="{{ old('date', $income->date ?? '') }}" name="incomedate"
                        id="incomedate">
                </div>
                <div class="col-12 text-center">
                    <a href="{{ route('manage.income') }}" class="admin-back-btn">Back</a>
                    <input type="submit" name="addIncome" class="admin-back-btn" value="{{ $income ? 'Update details' : 'Add income' }}">
                </div>
            </form>
        </div>
    </div>
@endsection
