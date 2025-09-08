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
                <h3 class="text-success">${{ number_format($total_balance, 2) }}</h3>
            </div>
            <div class="col-md-4">
                <h5>Total Income</h5>
                <h3 class="text-primary">${{ number_format($total_income, 2) }}</h3>
            </div>
            <div class="col-md-4">
                <h5>Total Expense</h5>
                <h3 class="text-danger">${{ number_format($total_expense, 2) }}</h3>
            </div>
        </div>

        <!-- Add Expense/Income Form -->
        <div class="mb-5">
            <h5>Add New Transaction</h5>
            <form action="{{ route('expenses.store') }}" method="POST">
                @csrf
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label for="today_date" class="form-label">Date</label>
                        <input type="date" name="today_date" id="today_date" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" name="description" id="description" class="form-control" required>
                    </div>
                    <div class="col-md-2">
                        <label for="category" class="form-label">Category</label>
                        <select name="category" id="category" class="form-select" required>
                            <option value="Income">Income</option>
                            <option value="Expense">Expense</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" step="0.01" name="amount" id="amount" class="form-control" required>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Add</button>
                    </div>
                </div>
            </form>
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