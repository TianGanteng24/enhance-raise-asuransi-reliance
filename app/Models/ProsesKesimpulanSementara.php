<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProsesKesimpulanSementara extends Model
{
    use HasFactory;

    protected $fillable = [
        'investigasi_id','flag','proses_kesimpulan_sementara','active'
    ];
}
