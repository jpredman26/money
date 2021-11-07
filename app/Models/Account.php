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
        'start_balance',
        'current_balance',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
