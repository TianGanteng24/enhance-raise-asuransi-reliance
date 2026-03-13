<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendalamanInvestigasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'investigasi_id','pendalaman'
    ];
}
