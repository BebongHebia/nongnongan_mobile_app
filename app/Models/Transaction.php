<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_code',
        'user_id',
        'document_type',
        'name',
        'address',
        'bday',
        'bplace',
        'sex',
        'civil_status',
        'purpose',
        'validity',
        'or_no',
        'status',
        'ref_no',
        'remarks',
        'schedule',
    ];

    public function get_user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
