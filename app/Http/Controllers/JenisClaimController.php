<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisClaim;


use Yajra\DataTables\DataTables;

class JenisClaimController extends Controller
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
        if ($request->ajax()) {
            $data = JenisClaim::select('*')->orderBy('created_at','DESC');
            return DataTables::of($data)
                    ->addIndexColumn()        
                     ->addColumn('action', function($row){
                        $btn = '<div class="btn-group"><a href="javascript:void(0)" id="'.$row->id.'" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled btn-edit"
                                data-bs-toggle="tooltip" title="Edit"><i class="fa fa-fw fa-pencil-alt"></i></span>';
                        $btn .= '<a href="javascript:void(0)" id="'.$row->id.'" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled btn-delete"
                                data-bs-toggle="tooltip" title="Delete"><i class="fa fa-fw fa-times"></i></a></div>';
                        return $btn;
                    })
                    ->escapeColumns([])
                    ->make(true);
        }
        
        return view('master.jenisclaim');
    }

    public function datajson()
	{
		return Datatables::of(JenisClaim::all())->make(true);
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
        JenisClaim::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = JenisClaim::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $jenisClaim = JenisClaim::find($id);
        $jenisClaim->jenis_klaim = request('jenis_klaim');
        $jenisClaim->keterangan = request('keterangan');
        
        $jenisClaim->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        JenisClaim::find($id)->delete();
    }
}
