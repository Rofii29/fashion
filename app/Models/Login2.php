<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login2 extends Model
{
    use HasFactory;

    protected $table = 'login2';

    protected $fillable = [
        'nama', 'nomor', 'email', 'password',
    ];

    protected $hidden = [
        'password',
    ];
}
