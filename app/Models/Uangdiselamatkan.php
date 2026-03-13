<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uangdiselamatkan extends Model
{
    use HasFactory;
    protected $fillable = [
        'uangdiselamatkan_id','investigasi_id','nominal','keterangan'
    ];
}
