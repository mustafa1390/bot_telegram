<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BotUser extends Model
{
    protected $fillable = [
        'wallet_id',
        'firstname',
        'lastname',
        'email',
        'password',
        'verifyimg',
        'phonenum',
        'fullname',
    ];
}
