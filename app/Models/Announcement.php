<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [

        'added_by',
        'title',
        'details',
    ];

    public function get_added_by(){
        return $this->belongsTo(User::class, 'added_by');
    }

}
