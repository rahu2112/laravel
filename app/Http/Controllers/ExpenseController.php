<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userid = Auth::id();

        $totalincome = Expense::where('user_id', $userid)
            ->where('category', 'Income')
            ->sum('amount');

        $totalexpense = Expense::where('user_id', $userid)
            ->where('category', '!=', 'Income')
            ->sum('amount');

        $totalbalance = $totalincome - $totalexpense;

        $currentmonthexpenses = Expense::where('user_id', $userid)
            ->whereMonth('today_date', now()->month)
            ->whereYear('today_date', now()->year)
            ->get();

        $lastmonthexpenses = Expense::where('user_id', $userid)
            ->whereMonth('today_date', now()->subMonth()->month)
            ->whereYear('today_date', now()->subMonth()->year)
            ->get();

        return view('index', compact(
            'totalbalance',
            'totalincome',
            'totalexpense',
            'currentmonthexpenses',
            'lastmonthexpenses'
        ));
    }
}