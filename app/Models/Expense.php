<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    // agar table ka naam default (expenses) hai to ye line optional hai
    protected $table = 'expenses';

    protected $fillable = [
        'user_id',
        'total_balance',
        'note',
        'total_income',
        'source',
        'from_date',
        'to_date',
        'today_date',
        'description',
        'category',
        'amount',
    ];
}
