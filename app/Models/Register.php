<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable; // Trait
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Register extends Model implements AuthenticatableContract
{
    use HasFactory, Authenticatable; // Add Authenticatable trait

    protected $table = 'register';

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'dob',
        'gender',
        'profile_photo'
    ];

    protected $hidden = ['password'];
}
