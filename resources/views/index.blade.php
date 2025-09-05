<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracker</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
    body {
        background-color: #f5f6fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .navbar {
        background: linear-gradient(90deg, #4facfe, #00f2fe);
    }

    .navbar-brand {
        font-weight: bold;
        color: white !important;
    }

    .summary-card {
        border-radius: 15px;
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.08);
        transition: 0.3s;
        position: relative;
    }

    .summary-card:hover {
        transform: translateY(-5px);
    }

    .summary-icon {
        font-size: 2rem;
        margin-bottom: 10px;
    }

    .add-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 0.9rem;
    }

    .btn-custom {
        background: linear-gradient(90deg, #43e97b, #38f9d7);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 6px 14px;
    }

    .btn-custom:hover {
        opacity: 0.9;
    }

    .table thead {
        background: #f1f3f6;
    }

    .progress-bar {
        font-weight: bold;
        transition: width 1s ease-in-out;
        /* smooth animation */
    }

    .progress-bar.blue-purple {
        background: linear-gradient(90deg, #00c6ff, #7d2ae8);
        color: #fff;
    }

    .progress-bar.pink-orange {
        background: linear-gradient(90deg, #ff758c, #ff7eb3, #ffb347);
        color: #fff;
    }

    .progress-bar.red-purple {
        background: linear-gradient(90deg, #ff0844, #ff416c, #6a11cb);
        color: #fff;
    }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="bi bi-cash-stack"></i> Expense Tracker</a>
            <button class="btn btn-light"><i class="bi bi-box-arrow-right"></i> Logout</button>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container my-5">

        <!-- Summary Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="card text-center p-4 summary-card">
                    <button class="btn btn-sm btn-outline-success add-btn" data-bs-toggle="modal"
                        data-bs-target="#balanceModal">
                        <i class="bi bi-plus-circle"></i> Add
                    </button>
                    <i class="bi bi-wallet2 text-success summary-icon"></i>
                    <h5>Total Balance</h5>
                    <h2 class="text-success">$1,200</h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center p-4 summary-card">
                    <button class="btn btn-sm btn-outline-primary add-btn" data-bs-toggle="modal"
                        data-bs-target="#incomeModal">
                        <i class="bi bi-plus-circle"></i> Add
                    </button>
                    <i class="bi bi-graph-up-arrow text-primary summary-icon"></i>
                    <h5>Total Income</h5>
                    <h2 class="text-primary">$2,000</h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center p-4 summary-card">
                    <i class="bi bi-cart-dash text-danger summary-icon"></i>
                    <h5>Total Expense</h5>
                    <h2 class="text-danger">$800</h2>
                </div>
            </div>
        </div>

        <!-- Budget Tracker Section -->
        <div class="card mb-5">
            <div class="card-header">
                <h5><i class="bi bi-bar-chart-line"></i> Budget Tracker</h5>
            </div>
            <div class="card-body">
                <p id="totalBudget"><strong>Total Budget:</strong> $1000</p>
                <p id="usedExpense"><strong>Used Expense:</strong> $650</p>
                <p id="remaining"><strong>Remaining:</strong> $350</p>

                <!-- Progress Bar -->
                <div class="progress" style="height: 28px; border-radius: 15px; overflow: hidden;">
                    <div id="budgetProgress" class="progress-bar" role="progressbar" style="width: 0%;">
                        0%
                    </div>
                </div>
            </div>
        </div>

        <!-- Calendar Section -->
        <div class="card mb-5">
            <div class="card-header">
                <h5><i class="bi bi-calendar-date"></i> Select Date Range</h5>
            </div>
            <div class="card-body row g-3">
                <div class="col-md-6">
                    <label class="form-label">From Date</label>
                    <input type="date" id="fromDate" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">To Date</label>
                    <input type="date" id="toDate" class="form-control">
                </div>

            </div>
        </div>


        <!-- Filter + Current Month Expenses -->
        <div class="card mb-5">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-calendar-event"></i> Current Month Expenses</h5>
                <div class="d-flex align-items-center gap-2">
                    <button class="btn btn-custom btn-sm" data-bs-toggle="collapse" data-bs-target="#addExpenseForm">
                        <i class="bi bi-plus-circle"></i> Add Expense
                    </button>
                </div>
            </div>

            <!-- Hidden Add Expense Form -->
            <div class="collapse" id="addExpenseForm">
                <div class="card-body border-top">
                    <form class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Date</label>
                            <input type="date" id="expenseDate" class="form-control" required>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Description</label>
                            <input type="text" class="form-control" placeholder="Expense detail" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Category</label>
                            <select class="form-select" required>
                                <option>Food</option>
                                <option>Travel</option>
                                <option>Utilities</option>
                                <option>Shopping</option>
                                <option>Other</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Amount</label>
                            <input type="number" class="form-control" placeholder="0.00" required>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-success w-100"><i class="bi bi-save"></i> Save</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Expense Table -->
            <div class="card-body">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Amount</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2025-09-05</td>
                            <td><i class="bi bi-basket text-warning"></i> Groceries</td>
                            <td>Food</td>
                            <td class="text-danger">- $50</td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-primary"><i
                                        class="bi bi-pencil-square"></i></button>
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>2025-09-04</td>
                            <td><i class="bi bi-currency-dollar text-success"></i> Salary</td>
                            <td>Income</td>
                            <td class="text-success">+ $2000</td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-primary"><i
                                        class="bi bi-pencil-square"></i></button>
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <!-- Last Month Expenses -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-clock-history"></i> Last Month Expenses (August 2025)</h5>
            </div>
            <div class="card-body">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2025-08-28</td>
                            <td><i class="bi bi-lightning-charge text-warning"></i> Electricity Bill</td>
                            <td>Utilities</td>
                            <td class="text-danger">- $120</td>
                        </tr>
                        <tr>
                            <td>2025-08-20</td>
                            <td><i class="bi bi-wifi text-info"></i> Internet Bill</td>
                            <td>Utilities</td>
                            <td class="text-danger">- $40</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Balance Modal -->
    <div class="modal fade" id="balanceModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-wallet2"></i> Add Balance</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Amount</label>
                            <input type="number" class="form-control" placeholder="Enter balance">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Note</label>
                            <input type="text" class="form-control" placeholder="Optional note">
                        </div>
                        <button type="submit" class="btn btn-success">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Income Modal -->
    <div class="modal fade" id="incomeModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-graph-up-arrow"></i> Add Income</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Amount</label>
                            <input type="number" class="form-control" placeholder="Enter income">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Source</label>
                            <input type="text" class="form-control" placeholder="Salary, Freelance, etc.">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <!-- date script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    const fromDate = document.getElementById("fromDate");
    const toDate = document.getElementById("toDate");

    const today = new Date();
    const yyyy = today.getFullYear();
    const mm = String(today.getMonth() + 1).padStart(2, "0");
    const dd = String(today.getDate()).padStart(2, "0");
    const todayDate = `${yyyy}-${mm}-${dd}`;

    // From date settings
    fromDate.value = todayDate;
    fromDate.min = todayDate;

    // To date settings
    toDate.value = todayDate;
    toDate.min = todayDate;

    // Update "toDate" min when fromDate changes
    fromDate.addEventListener("change", () => {
        toDate.min = fromDate.value;
        if (toDate.value < fromDate.value) {
            toDate.value = fromDate.value;
        }
    });
    </script>

    <!-- expence scriptbar -->
    <script>
    // Example values
    const totalBudget = 1000;
    const usedExpense = 650;

    const remaining = totalBudget - usedExpense;
    const percentUsed = (usedExpense / totalBudget) * 100;

    // Update text
    document.getElementById("totalBudget").innerHTML = `<strong>Total Budget:</strong> $${totalBudget}`;
    document.getElementById("usedExpense").innerHTML = `<strong>Used Expense:</strong> $${usedExpense}`;
    document.getElementById("remaining").innerHTML = `<strong>Remaining:</strong> $${remaining}`;

    // Update progress bar
    const progressBar = document.getElementById("budgetProgress");
    progressBar.style.width = percentUsed + "%";
    progressBar.innerText = Math.round(percentUsed) + "%";

    // Reset old colors
    progressBar.classList.remove("blue-purple", "pink-orange", "red-purple");

    // Apply new gradient color scheme
    if (percentUsed <= 50) {
        progressBar.classList.add("blue-purple"); // Safe
    } else if (percentUsed <= 80) {
        progressBar.classList.add("pink-orange"); // Warning
    } else {
        progressBar.classList.add("red-purple"); // Danger
    }
    </script>
    <!-- add date script -->
    <script>
    const fromDate = document.getElementById("fromDate"); // calendar section "From"
    const toDate = document.getElementById("toDate"); // calendar section "To"
    const expenseDate = document.getElementById("expenseDate"); // add expense form date

    // function to update expenseDate min & max
    function updateExpenseDateRange() {
        expenseDate.min = fromDate.value;
        expenseDate.max = toDate.value;
        // default value set karo if not in range
        if (expenseDate.value < fromDate.value || expenseDate.value > toDate.value) {
            expenseDate.value = fromDate.value;
        }
    }

    // event listeners
    fromDate.addEventListener("change", updateExpenseDateRange);
    toDate.addEventListener("change", updateExpenseDateRange);

    // run once on load
    updateExpenseDateRange();
    </script>

</body>

</html>