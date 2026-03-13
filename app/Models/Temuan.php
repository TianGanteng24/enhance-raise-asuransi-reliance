<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temuan extends Model
{
    use HasFactory;
    protected $fillable = [
        'temaun_id','investigasi_id','tanggal','temuan'
    ];
}
