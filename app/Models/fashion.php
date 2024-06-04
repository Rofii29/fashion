<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fashion extends Model
{
    use HasFactory;
    protected $table = "fashion";
    protected $fillable = ['nama', 'nomortelp', 'alamat', 'gambar', 'text'];
}
