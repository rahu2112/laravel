<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();

        // total income
        $total_income = Expense::where('user_id', $user_id)
            ->where('category', 'Income')
            ->sum('amount');

        // total expense (exclude income)
        $total_expense = Expense::where('user_id', $user_id)
            ->where('category', '!=', 'Income')
            ->sum('amount');

        // total balance
        $total_balance = $total_income - $total_expense;

        // current month expenses
        $currentmonthexpenses = Expense::where('user_id', $user_id)
            ->whereMonth('today_date', now()->month)
            ->whereYear('today_date', now()->year)
            ->orderBy('today_date', 'desc')
            ->get();

        // last month expenses
        $lastmonthexpenses = Expense::where('user_id', $user_id)
            ->whereMonth('today_date', now()->subMonth()->month)
            ->whereYear('today_date', now()->subMonth()->year)
            ->orderBy('today_date', 'desc')
            ->get();

        return view('index', compact(
            'total_balance',
            'total_income',
            'total_expense',
            'currentmonthexpenses',
            'lastmonthexpenses'
        ));
    }
}
