<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhatsappNumber extends Model
{
    protected $guarded = [];
    
    protected $casts = [
        'status_active' => 'boolean',
    ];
}