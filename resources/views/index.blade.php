<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Expense Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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

        .table {
            border-radius: 12px;
            overflow: hidden;
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

        label {
            color: #ddd;
        }

        .btn-primary {
            background: linear-gradient(45deg, #06beb6, #48b1bf);
            border: none;
            border-radius: 10px;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #48b1bf, #06beb6);
        }

        h5 {
            color: #ddd;
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
                    <h3 id="total-balance" class="text-success">$0.00</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="summary-card">
                    <h5>Total Income</h5>
                    <h3 id="total-income" class="text-primary">$0.00</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="summary-card">
                    <h5>Total Expense</h5>
                    <h3 id="total-expense" class="text-danger">$0.00</h3>
                </div>
            </div>
        </div>

        <!-- Add Expense/Income Form -->
        <div class="mb-5">
            <h5>Add New Transaction</h5>
            <form id="transaction-form">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label for="today_date" class="form-label">Date</label>
                        <input type="date" id="today_date" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" id="description" class="form-control" required>
                    </div>
                    <div class="col-md-2">
                        <label for="category" class="form-label">Category</label>
                        <select id="category" class="form-select" required>
                            <option value="Income">Income</option>
                            <option value="Expense">Expense</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" step="0.01" id="amount" class="form-control" required>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Add</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Current Month Expenses -->
        <div class="mb-4">
            <h5>Current Month Transactions</h5>
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody id="current-month-list">
                </tbody>
            </table>
        </div>

        <!-- Last Month Expenses -->
        <div>
            <h5>Last Month Transactions</h5>
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody id="last-month-list">
                </tbody>
            </table>
        </div>

    </div>

    <script>
        const form = document.getElementById("transaction-form");
        const currentList = document.getElementById("current-month-list");
        const lastList = document.getElementById("last-month-list");

        const totalBalanceEl = document.getElementById("total-balance");
        const totalIncomeEl = document.getElementById("total-income");
        const totalExpenseEl = document.getElementById("total-expense");

        let transactions = JSON.parse(localStorage.getItem("transactions")) || [];

        function updateSummary() {
            let income = transactions
                .filter(t => t.category === "Income")
                .reduce((sum, t) => sum + t.amount, 0);

            let expense = transactions
                .filter(t => t.category === "Expense")
                .reduce((sum, t) => sum + t.amount, 0);

            totalIncomeEl.textContent = `$${income.toFixed(2)}`;
            totalExpenseEl.textContent = `$${expense.toFixed(2)}`;
            totalBalanceEl.textContent = `$${(income - expense).toFixed(2)}`;
        }

        function renderTransactions() {
            currentList.innerHTML = "";
            lastList.innerHTML = "";

            const now = new Date();
            const thisMonth = now.getMonth();
            const lastMonth = (thisMonth === 0) ? 11 : thisMonth - 1;
            const thisYear = now.getFullYear();
            const lastMonthYear = (thisMonth === 0) ? thisYear - 1 : thisYear;

            transactions.forEach(t => {
                const tr = document.createElement("tr");
                const sign = t.category === "Income" ? "+" : "-";
                const cls = t.category === "Income" ? "text-success" : "text-danger";

                tr.innerHTML = `
          <td>${t.date}</td>
          <td>${t.description}</td>
          <td>${t.category}</td>
          <td><span class="${cls}">${sign} $${t.amount.toFixed(2)}</span></td>
        `;

                const d = new Date(t.date);
                if (d.getMonth() === thisMonth && d.getFullYear() === thisYear) {
                    currentList.appendChild(tr);
                } else if (d.getMonth() === lastMonth && d.getFullYear() === lastMonthYear) {
                    lastList.appendChild(tr);
                }
            });
        }

        form.addEventListener("submit", e => {
            e.preventDefault();
            const date = document.getElementById("today_date").value;
            const description = document.getElementById("description").value;
            const category = document.getElementById("category").value;
            const amount = parseFloat(document.getElementById("amount").value);

            transactions.push({
                date,
                description,
                category,
                amount
            });
            localStorage.setItem("transactions", JSON.stringify(transactions));

            form.reset();
            updateSummary();
            renderTransactions();
        });

        // Initialize
        updateSummary();
        renderTransactions();
    </script>
</body>

</html>