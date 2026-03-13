<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LampiranFoto extends Model
{
    use HasFactory;
    protected $fillable = [
        'investigasi_id','title','path','keterangan'
    ];
}
