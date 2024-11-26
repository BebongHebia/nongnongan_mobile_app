<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Official extends Model
{
    use HasFactory;

    protected $fillable = [
        'complete_name',
        'sex',
        'bday',
        'address',
        'phone',
        'role',
        'fields',
        'status',
        'system_id',
    ];
}
