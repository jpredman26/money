<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'user_id' ,
        'start_balance',
        'current_balance',
    ];

    public function user()
    {
        $this->belongsTo('App\User');
    }
}
