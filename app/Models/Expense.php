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
        'today_date',
        'description',
        'category',
        'amount',
        'total_balance',
        'total_income',
        'note',
        'source',
        'from_date',
        'to_date',
    ];
}
