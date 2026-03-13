<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Polislain extends Model
{
    use HasFactory;

    protected $fillable = [
        'investigasi_id','asuransi_id','issued_polis','up'
    ];
}
