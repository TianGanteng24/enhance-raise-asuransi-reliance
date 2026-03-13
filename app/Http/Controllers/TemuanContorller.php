<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Temuan;

class TemuanContorller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function addTemuan(Request $request){
        temuan::create($request->all());
    }

    public function delTemuan($id){
        Temuan::find($id)->delete();
    }

    public function getIdTemuan($id){
        $data = Temuan::find($id);
        return response()->json($data);
    }

    public function updateTemuan(Request $request){
        $data = Temuan::find($request->id);
        $data->temuan = $request->temuan;
        $data->tanggal = $request->tanggal;
        $data->save();
        return response()->json($data, 200);
    }
}
