<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BotStatus extends Model
{
    protected $fillable = [
        'start',
        'register',
        'registerdone',
    ];
}
