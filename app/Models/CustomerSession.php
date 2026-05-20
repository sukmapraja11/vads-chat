<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerSession extends Model
{
       protected $fillable = [
        'customer_name',
        'email',
        'phone',
        'session_status',
        'last_activity'
    ];
}
