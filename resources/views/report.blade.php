@extends('adminLayout')
@section('content')
    <div class="report-container">
        <h2 class="freight-heading">Manage Report</h2>
        <hr>
        <h4>Select Date to generate report:</h4>
        <form action="{{ route('report.generate') }}" method="POST">
            @csrf
            <label for="start_date">Start Date:</label>
            <input type="date" id="start_date" name="start_date" required>
            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date" required>
            <button type="submit" id="admin-btn" class="btn btn-primary" name="generate_report">Generate Report</button>
        </form>

        @if (isset($expenses) && isset($incomes))
            @if ($expenses->isEmpty() && $incomes->isEmpty())
                <p>No records found!</p>
            @else
                <div class="report-content">
                    <div class="report">
                        <table class="table text-center reporttable">
                            <tr>
                                <th>
                                    <h3>Expense</h3>
                                </th>
                            </tr>
                            <tr>
                                <th scope="col">Type</th>
                                <th scope="col">Date</th>
                                <th scope="col">Amount</th>
                            </tr>
                            @foreach ($expenses as $expense)
                                <tr>
                                    <td>{{ $expense->type }}</td>
                                    <td>{{ $expense->date }}</td>
                                    <td>{{ $expense->amount }}</td>
                                </tr>
                            @endforeach
                        </table>

                        <table class="table text-center reporttable">
                            <tr>
                                <th>
                                    <h3>Income</h3>
                                </th>
                            </tr>
                            <tr>
                                <th scope="col">Source</th>
                                <th scope="col">Date</th>
                                <th scope="col">Amount</th>
                            </tr>
                            @foreach ($incomes as $income)
                                <tr>
                                    <td>{{ $income->source }}</td>
                                    <td>{{ $income->date }}</td>
                                    <td>{{ $income->amount }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>

                    <table class="table text-center">
                        <tr>
                            <th>Total Expense</th>
                            <td>{{ $totalExpense }}</td>
                            <th>Total Income</th>
                            <td>{{ $totalIncome }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Total Income - Total Expense</td>
                            <td>{{ $totalIncome }} - {{ $totalExpense }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <th>Net Profit</th>
                            <td>{{ $netProfit }}</td>
                        </tr>
                    </table>
                </div>
                <button id="admin-btn" onclick="window.print()">Print Report</button>
            @endif
        @endif
    </div>
@endsection
