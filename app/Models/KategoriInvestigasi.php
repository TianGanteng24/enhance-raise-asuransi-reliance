<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriInvestigasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_investigasi','keterangan'
    ];

    public function upinvestigasi(){
        return $this->belongsTo(Updateinvestigasi::class);
    }
}
