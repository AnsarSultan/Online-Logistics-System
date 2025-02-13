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
        <div class="expenses">
            <div class="add-expense-form-container">
                <form class="row g-3 add-expense-form" method="POST" action="{{ route('update.income', $income->id) }}">
                    @csrf
                    <div class="col-md-12 text-center">
                        <h3 class="title">Add Income</h3>
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
                        <input type="text" class="form-control" value="{{$income->source}}" name="incomesource" id="incomesource">
                    </div>
                    <div class="col-md-6">
                        <label for="incomeamount" class="form-label">Income amount</label>
                        <input type="number" class="form-control"  value="{{$income->amount}}" name="incomeamount" id="incomeamount">
                    </div>
                    <div class="col-12">
                        <label for="incomedate" class="form-label">Expense Date</label>
                        <input type="date" class="form-control" value="{{$income->date}}"  name="incomedate" id="incomedate">
                    </div>
                    <div class="col-12 text-center">
                        <a href="{{ route('manage.income') }}" class="admin-back-btn">Back</a>
                        <input type="submit" name="addIncome" class="admin-back-btn" value="Update details">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
