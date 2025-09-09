<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Expense;

class ExpenseController extends Controller
{
    /**
     * Show index page with summary + transactions
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login first!');
        }

        $transactions = Expense::where('user_id', Auth::id())
            ->orderBy('today_date', 'desc')
            ->get();

        $income  = $transactions->where('category', 'Income')->sum('amount');
        $expense = $transactions->where('category', 'Expense')->sum('amount');
        $balance = $income - $expense;

        return view('index', compact('transactions', 'income', 'expense', 'balance'));
    }

    /**
     * Store new transaction
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login first!');
        }

        $validated = $request->validate([
            'today_date'  => 'required|date',
            'description' => 'required|string|max:255',
            'category'    => 'required|string|in:Income,Expense',
            'amount'      => 'required|numeric|min:1',
            'note'        => 'nullable|string|max:255',
            'source'      => 'nullable|string|max:255',
        ]);

        Expense::create([
            'user_id'       => Auth::id(),
            'today_date'    => $validated['today_date'],
            'description'   => $validated['description'],
            'category'      => $validated['category'],
            'amount'        => $validated['amount'],
            'note'          => $validated['note'] ?? null,
            'source'        => $validated['source'] ?? null,
            'income'  => $validated['category'] === 'Income' ? $validated['amount'] : 0,
            'balance' => 0, // calculate in index
        ]);

        return redirect()->route('index')->with('success', 'Transaction added successfully!');
    }
}
