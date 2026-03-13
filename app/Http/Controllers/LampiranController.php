<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LampiranFoto;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Carbon;
use Auth;
use Validator;
use Image;

class LampiranController extends Controller
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
        //
    }

    public function getLampiranFoto(Request $request,$id)
    {
        if(request()->ajax())
        {
            $data = DB::table('lampiran_fotos')
                    ->select('*')
                    ->where('investigasi_id', $id )
                    ->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('gambar', function($row){
                $foto_ls ='<img src="/storage/'.$row->path.'" width="300px">';
                return $foto_ls;
            })    
            ->addColumn('action', function($row){
                $btn = '<a href="javascript:void(0)" id="'.$row->id.'" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled btn-edit"
                    data-bs-toggle="tooltip" title="Edit"><i class="fa fa-fw fa-pencil-alt"></i></a>';
                $btn .= '<a href="javascript:void(0)" id="'.$row->id.'" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled btn-delete"
                        data-bs-toggle="tooltip" title="Delete"><i class="fa fa-fw fa-times"></i></a></div>';
                return $btn;
            })
            ->escapeColumns([])
            ->make(true);
            // dd($data);
        }
        
        return response()->json(['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function uploadLampiran(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required',
            'images' => 'required',
        ]);

        $details = [
                'investigasi_id' => $request->investigasi_id,
                'title' => $request->judul,
                'keterangan' => $request->keterangan,
        ];

        $id_lampiran = $request->id;
        $image = $request->file('images');
        $filename = $image->getClientOriginalName().time().'.'.$image->getClientOriginalExtension();
        $details['path'] = $filename; 

        $details['path'] = time().'.'.$image->extension();
     
        // $destinationPath = public_path('/storage');
        $img = Image::make($image->path());
        $img->resize(1000, 1000, function ($constraint) {
            $constraint->aspectRatio();
        })->save('storage'.'/'.$details['path']);
   
        
        $ext_lamp =   LampiranFoto::updateOrCreate(['id' => $id_lampiran], $details);
        if($ext_lamp){
            return response()->json(['code'=>1,'msg'=>'Data Success Saved..']);
        }else{
            return response()->json(['code'=>0,'msg'=>'Data Error Saved..']);
        }
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getIdLampiranFoto($id)
    {
       $data = LampiranFoto::find($id);

       if(!empty($data)){
        return response()->json(['code'=>1,'msg'=>'Data is Find','result'=>$data]);
    }else{
        return response()->json(['code'=>0,'msg'=>'Data not found..']);
    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    public function delLampiranFoto($id)
    {
        LampiranFoto::find($id)->delete();
    }
}
