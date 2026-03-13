<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendalamanInvestigasi;
use App\Models\Investigasi;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class PendalamanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        PendalamanInvestigasi::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $data = Investigasi::findOrFail($id)
                    ->join('asuransis','investigasis.asuransi_id','=','asuransis.id')
                    ->join('investigators','investigasis.investigator_id','=','investigators.id')
                    ->select('investigasis.*','asuransis.nm_perusahaan','investigators.nm_investigator')
                    ->where('investigasis.id', $id )
                    ->first();

        if ($request->ajax()) {
            $data = DB::table('pendalaman_investigasis as pi')
                    ->select('pi.*')
                    ->where('pi.investigasi_id',$id)
                    ->get();

            return DataTables::of($data)
                    ->addIndexColumn()        
                    ->addColumn('action', function($row){
                           $btn = '<div class="btn-group"><a href="javascript:void(0)" id="'.$row->id.'" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled btn-delete"
                                    data-bs-toggle="tooltip" title="Delete"><i class="fa fa-fw fa-times"></i></a></div>';
                           return $btn;
                    })
                    ->escapeColumns([])
                    ->make(true);
        }
        return view('investigasi.pendalaman',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(request()->ajax()) {
            $data = PendalamanIvestigasi::FindOrFail($id);
            return response()->json(['data'=>$data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PendalamanInvestigasi $pendalaman)
    {
        $pendalaman->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PendalamanInvestigasi::find($id)->delete();
    }
}
