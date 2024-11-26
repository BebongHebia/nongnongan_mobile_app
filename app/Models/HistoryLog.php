<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryLog extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'role',
        'transaction_code',
        'transaction_id',
        'remarks',
        'date',
    ];


    public function get_responsible(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
