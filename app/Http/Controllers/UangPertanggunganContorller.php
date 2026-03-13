<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Uangdiselamatkan;

class UangPertanggunganContorller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function addUangPertanggungan(Request $request){
        Uangdiselamatkan::create($request->all());
    }

    public function delUangPertanggungan($id){
        Uangdiselamatkan::find($id)->delete();
    }

    public function getIdUangPertanggungan($id){
        $data = Uangdiselamatkan::find($id);
        return response()->json($data);
    }

    public function updateUangPertanggungan(Request $request){
        $data = Uangdiselamatkan::find($request->id);
        $data->nominal = $request->nominal;
        $data->keterangan = $request->keterangan;
        $data->save();
        return response()->json($data, 200);
    }
}
