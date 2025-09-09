<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Expense Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
    body {
        background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
        color: #f1f1f1;
        min-height: 100vh;
    }

    .summary-card {
        border-radius: 16px;
        padding: 20px;
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: transform 0.2s ease;
    }

    .summary-card:hover {
        transform: translateY(-5px);
    }

    .table thead {
        background: rgba(255, 255, 255, 0.1);
        color: #fff;
    }

    .table tbody tr:hover {
        background: rgba(255, 255, 255, 0.05);
    }

    .form-control,
    .form-select {
        background: rgba(255, 255, 255, 0.1);
        border: none;
        color: #fff;
    }

    .form-control:focus,
    .form-select:focus {
        background: rgba(255, 255, 255, 0.15);
        box-shadow: none;
        color: #fff;
    }

    .btn-primary {
        background: linear-gradient(45deg, #06beb6, #48b1bf);
        border: none;
        border-radius: 10px;
    }

    .btn-primary:hover {
        background: linear-gradient(45deg, #48b1bf, #06beb6);
    }
    </style>
</head>

<body>
    <div class="container mt-5">

        <!-- Summary -->
        <div class="row text-center mb-4">
            <div class="col-md-4">
                <div class="summary-card">
                    <h5>Total Balance</h5>
                    <h3 class="text-success">₹{{ number_format($balance, 2) }}</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="summary-card">
                    <h5>Total Income</h5>
                    <h3 class="text-primary">₹{{ number_format($income, 2) }}</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="summary-card">
                    <h5>Total Expense</h5>
                    <h3 class="text-danger">₹{{ number_format($expense, 2) }}</h3>
                </div>
            </div>
        </div>

        <!-- Add Expense/Income Form -->
        <div class="mb-5">
            <h5>Add New Transaction</h5>
            <form action="{{ route('expence.store') }}" method="POST">
                @csrf
                <div class="row g-3 align-items-end">
                    <div class="col-md-2">
                        <label class="form-label">Date</label>
                        <input type="date" name="today_date" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Description</label>
                        <input type="text" name="description" class="form-control" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Category</label>
                        <select name="category" class="form-select" required>
                            <option value="Income">Income</option>
                            <option value="Expense">Expense</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Amount</label>
                        <input type="number" step="0.01" name="amount" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Source</label>
                        <input type="text" name="source" class="form-control">
                    </div>
                    <div class="col-md-12 mt-3">
                        <label class="form-label">Note</label>
                        <input type="text" name="note" class="form-control">
                    </div>
                    <div class="col-md-12 mt-3">
                        <button type="submit" class="btn btn-primary w-100">Add Transaction</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Transactions Table -->
        <div>
            <h5>All Transactions</h5>
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Amount</th>
                        <th>Source</th>
                        <th>Note</th>
                        <th>Total Income</th>
                        <th>Total Balance</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $t)
                    <tr>
                        <td>{{ $t->today_date }}</td>
                        <td>{{ $t->description }}</td>
                        <td>
                            <span class="{{ $t->category == 'Income' ? 'text-success' : 'text-danger' }}">
                                {{ $t->category }}
                            </span>
                        </td>
                        <td>₹{{ number_format($t->amount, 2) }}</td>
                        <td>{{ $t->source }}</td>
                        <td>{{ $t->note }}</td>
                        <td>₹{{ number_format($t->income, 2) }}</td>
                        <td>₹{{ number_format($t->balance, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</body>

</html>