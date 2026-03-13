<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Polislain;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class PolisLainController extends Controller
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
    public function index(Request $request)
    {
        $ids = $request->id;
        if ($request->ajax()) {
            $data = Polislain::select('*')
                    ->where('investigasi_id',$ids)
                    ->orderBy('created_at','DESC');
            return DataTables::of($data)
                    ->addIndexColumn()        
                     ->addColumn('action', function($row){
                           $btn = '<a href="javascript:void(0)" id="'.$row->id.'" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled btn-delete-polis"
                                    data-bs-toggle="tooltip" title="Delete"><i class="fa fa-fw fa-times"></i></a></div>';
                           return $btn;
                    })
                    ->escapeColumns([])
                    ->make(true);
        }
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
        Polislain::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {      
        if ($request->ajax()) {
            $data = DB::table('polislains')
                    ->leftjoin('asuransis','polislains.asuransi_id','=','asuransis.id')
                    ->where('polislains.investigasi_id',$id)
                    ->select('polislains.*','asuransis.nm_perusahaan')
                    ->orderBy('polislains.created_at','DESC');
            return DataTables::of($data)
                    ->addIndexColumn()        
                     ->addColumn('action', function($row){
                           $btn = '<a href="javascript:void(0)" id="'.$row->id.'" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled btn-delete-polis"
                                    data-bs-toggle="tooltip" title="Delete"><i class="fa fa-fw fa-times"></i></a></div>';
                           return $btn;
                    })
                    ->escapeColumns([])
                    ->make(true);
        }
    }

    public function getPolis($id)
    {
        if(request()->ajax())
        {
            $data = Polislain::findOrFail($id)
                    ->join('asuransis','polislains.asuransi_id','=','asuransis.id')
                    // ->join('investigators','investigasis.investigator_id','=','investigators.id')
                    // ->join('updateinvestigasis','investigasis.id','=','updateinvestigasis.investigasi_id')
                    // ->join('kategori_investigasis','kategori_investigasis.id','=','updateinvestigasis.kategoriinvestigasi_id')
                    // ->select('investigasis.*','asuransis.nm_perusahaan','investigators.nm_investigator')
                    ->select('polislains.*','asuransis.nm_perusahaan')
                    ->where('polislains.asuransi_id', $id )
                    ->get();
            
        }

        return response()->json(['data' => $data]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Polislain::find($id)->delete();
    }
}
