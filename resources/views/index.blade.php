<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Expense Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">

        <!-- Summary -->
        <div class="row text-center mb-4">
            <div class="col-md-4">
                <h5>Total Balance</h5>
                <h3 class="text-success">${{ number_format($totalbalance, 2) }}</h3>
            </div>
            <div class="col-md-4">
                <h5>Total Income</h5>
                <h3 class="text-primary">${{ number_format($totalincome, 2) }}</h3>
            </div>
            <div class="col-md-4">
                <h5>Total Expense</h5>
                <h3 class="text-danger">${{ number_format($totalexpense, 2) }}</h3>
            </div>
        </div>

        <!-- Current Month Expenses -->
        <div class="mb-4">
            <h5>Current Month Expenses</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($currentmonthexpenses as $expense)
                    <tr>
                        <td>{{ $expense->today_date }}</td>
                        <td>{{ $expense->description }}</td>
                        <td>{{ $expense->category }}</td>
                        <td>
                            @if($expense->category === 'Income')
                            <span class="text-success">+ ${{ number_format($expense->amount, 2) }}</span>
                            @else
                            <span class="text-danger">- ${{ number_format($expense->amount, 2) }}</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Last Month Expenses -->
        <div>
            <h5>Last Month Expenses</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lastmonthexpenses as $expense)
                    <tr>
                        <td>{{ $expense->today_date }}</td>
                        <td>{{ $expense->description }}</td>
                        <td>{{ $expense->category }}</td>
                        <td>
                            @if($expense->category === 'Income')
                            <span class="text-success">+ ${{ number_format($expense->amount, 2) }}</span>
                            @else
                            <span class="text-danger">- ${{ number_format($expense->amount, 2) }}</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</body>

</html>