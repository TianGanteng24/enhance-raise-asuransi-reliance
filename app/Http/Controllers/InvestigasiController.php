<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matauang;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Investigasi;
use App\Models\KategoriInvestigasi;
use App\Models\Updateinvestigasi;
use App\Models\Investigator;
use App\Models\Asuransi;
use App\Models\JenisClaim;
use App\Models\Provinsi;
use App\Models\Kesimpulan;
use App\Models\Rekomendasi;
use App\Models\LampiranFoto;
use App\Models\ProsesKesimpulanSementara;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Carbon;
use Auth;
use Validator;
use App\Http\Requests\InvestigasiRequest;

use PDF;

class InvestigasiController extends Controller
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
        $user_id = Auth::user();
        $data = [];

        if (($user_id->role =='master' or $user_id->role =='spv')){
            $data = DB::table('investigasis')
            ->leftjoin('asuransis','investigasis.asuransi_id','=','asuransis.id')
            ->leftjoin('investigators','investigasis.investigator_id','=','investigators.id')
            ->leftjoin('users','investigasis.user_id','=','users.id')
            ->select('investigasis.*','asuransis.nm_perusahaan','investigators.nm_investigator',
                        'users.name as username')
            ->orderBy('created_at', 'DESC')
            ->get();
        }
        if ($user_id->role =='user'){
            $data = DB::table('investigasis')
            ->leftjoin('asuransis','investigasis.asuransi_id','=','asuransis.id')
            ->leftjoin('investigators','investigasis.investigator_id','=','investigators.id')
            ->leftjoin('users','investigasis.user_id','=','users.id')
            ->select('investigasis.*','asuransis.nm_perusahaan','investigators.nm_investigator',
                    'users.name as username')
            ->orderBy('created_at', 'DESC')
            ->where('investigasis.user_id',$user_id->id)
            ->get();
        }
        
        return view('investigasi.list',compact('data','user_id'));
    }

    public function getOnGoing(Request $request)
    {
        $user_id = Auth::user();
        $data = [];

        if (($user_id->role =='master' or $user_id->role =='spv')){
            $data = DB::table('investigasis')
            ->leftjoin('asuransis','investigasis.asuransi_id','=','asuransis.id')
            ->leftjoin('investigators','investigasis.investigator_id','=','investigators.id')
            ->leftjoin('users','investigasis.user_id','=','users.id')
            ->select('investigasis.*','asuransis.nm_perusahaan','investigators.nm_investigator',
                        'users.name as username')
            ->where('investigasis.status',0)
            ->orderBy('created_at', 'DESC')
            ->get();
        }
        if ($user_id->role =='user'){
            $data = DB::table('investigasis')
            ->leftjoin('asuransis','investigasis.asuransi_id','=','asuransis.id')
            ->leftjoin('investigators','investigasis.investigator_id','=','investigators.id')
            ->leftjoin('users','investigasis.user_id','=','users.id')
            ->select('investigasis.*','asuransis.nm_perusahaan','investigators.nm_investigator',
                    'users.name as username')
            ->orderBy('created_at', 'DESC')
            ->where('investigasis.user_id',$user_id->id)
            ->where('investigasis.status',0)
            ->get();
        }
        
        return view('investigasi.list',compact('data','user_id'));
    }

    public function waitApprove(Request $request)
    {
        $user_id = Auth::user();

        if (($user_id->role =='master' or $user_id->role =='spv')){
            $data = DB::table('investigasis')
            ->leftjoin('asuransis','investigasis.asuransi_id','=','asuransis.id')
            ->leftjoin('investigators','investigasis.investigator_id','=','investigators.id')
            ->leftjoin('users','investigasis.user_id','=','users.id')
            ->select('investigasis.*','asuransis.nm_perusahaan','investigators.nm_investigator',
                        'users.name as username')
            ->where('investigasis.status',2)
            ->orderBy('created_at', 'DESC')
            ->get();
        }
        if ($user_id->role =='user'){
            $data = DB::table('investigasis')
            ->leftjoin('asuransis','investigasis.asuransi_id','=','asuransis.id')
            ->leftjoin('investigators','investigasis.investigator_id','=','investigators.id')
            ->leftjoin('users','investigasis.user_id','=','users.id')
            ->select('investigasis.*','asuransis.nm_perusahaan','investigators.nm_investigator',
                    'users.name as username')
            ->orderBy('created_at', 'DESC')
            ->where('investigasis.user_id',$user_id->id)
            ->where('investigasis.status',2)
            ->get();
        }
        
        return view('investigasi.list',compact('data','user_id'));
    }

    public function complete(Request $request)
    {
        $user_id = Auth::user();

        if (($user_id->role =='master' or $user_id->role =='spv')){
            $data = DB::table('investigasis')
            ->join('asuransis','investigasis.asuransi_id','=','asuransis.id')
            ->join('investigators','investigasis.investigator_id','=','investigators.id')
            ->join('users','investigasis.user_id','=','users.id')
            ->select('investigasis.*','asuransis.nm_perusahaan','investigators.nm_investigator',
                        'users.name as username')
            ->where('investigasis.status',1)
            ->orderBy('created_at', 'DESC')
            ->get();
        }
        if ($user_id->role =='user'){
            $data = DB::table('investigasis')
            ->join('asuransis','investigasis.asuransi_id','=','asuransis.id')
            ->join('investigators','investigasis.investigator_id','=','investigators.id')
            ->join('users','investigasis.user_id','=','users.id')
            ->select('investigasis.*','asuransis.nm_perusahaan','investigators.nm_investigator',
                    'users.name as username')
            ->orderBy('created_at', 'DESC')
            ->where('investigasis.user_id',$user_id->id)
            ->where('investigasis.status',1)
            ->get();
        }
        
        return view('investigasi.list',compact('data','user_id'));
    }



    public function getDetailUpdate($id)
    {
        if(request()->ajax())
        {
            $data = Investigasi::findOrFail($id)
                    ->join('asuransis','investigasis.asuransi_id','=','asuransis.id')
                    ->join('investigators','investigasis.investigator_id','=','investigators.id')
                    ->join('updateinvestigasis','investigasis.id','=','updateinvestigasis.investigasi_id')
                    ->join('kategori_investigasis','kategori_investigasis.id','=','updateinvestigasis.kategoriinvestigasi_id')
                    // ->select('investigasis.*','asuransis.nm_perusahaan','investigators.nm_investigator')
                    ->select('investigasis.status','updateinvestigasis.*','kategori_investigasis.kategori_investigasi')
                    ->where('investigasis.id', $id )
                    ->get();
            
            return DataTables::of($data)
            ->addIndexColumn()      
            ->addColumn('action', function($row){
                if($row->status=="0")
                return  '<div class="btn-group">
                <a href="javascript:void(0)" id="'.$row->id.'" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled btn-upload" 
                    data-bs-toggle="tooltip" title="Upload Foto"><i class="fa fa-fw fa-cloud-upload-alt"></i>
                <a href="javascript:void(0)" id="'.$row->id.'" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled btn-imageview"
                    data-bs-toggle="tooltip" title="View Foto"><i class="fa fa-fw fa-images"></i></a>
                <a href="javascript:void(0)" id="'.$row->id.'" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled btn-edit"
                    data-bs-toggle="tooltip" title="Edit"><i class="fa fa-fw fa-pencil-alt"></i></a>
                <a href="javascript:void(0)" id="'.$row->id.'" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled btn-delete-update"
                    data-bs-toggle="tooltip" title="Delete"><i class="fa fa-fw fa-times"></i></a>
            </div>';

                       
            })
            ->escapeColumns([])
            ->make(true);
            
        }

        return response()->json(['data' => $data]);
    }

    //GET LAMPIRAN, PENDALAMAN, PROSES KESIMPULAN SMT
    public function getLampiran($id)
    {
        $data = Investigasi::findOrFail($id)
                    ->join('asuransis','investigasis.asuransi_id','=','asuransis.id')
                    ->join('investigators','investigasis.investigator_id','=','investigators.id')
                    ->select('investigasis.*','asuransis.nm_perusahaan','investigators.nm_investigator')
                    ->where('investigasis.id',$id)
                    ->first();
        return view('investigasi.lampiran',compact('data'));
    }



    //END LAMPIRAN, PENDALAMAN, PROSES KESIMPULAN SMT


    public function getPolis(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = DB::table('polislains')
                    ->leftjoin('asuransis','polislains.asuransi_id','=','asuransis.id')
                    ->leftjoin('investigasis','investigasis.id','=','polislains.investigasi_id')
                    ->where('polislains.investigasi_id',$id)
                    ->select('polislains.*','asuransis.nm_perusahaan','investigasis.status')
                    ->orderBy('polislains.created_at','DESC');
            return DataTables::of($data)
                    ->addIndexColumn()        
                    ->addColumn('action', function($row){
                        if($row->status == "0")
                           return '<a href="javascript:void(0)" id="'.$row->id.'" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled btn-delete-polis"
                                    data-bs-toggle="tooltip" title="Delete"><i class="fa fa-fw fa-times"></i></a></div>';
                    })
                    ->escapeColumns([])
                    ->make(true);
        }
    }

    // Temuan

    public function getTemuan(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = DB::table('temuans')
                    ->leftjoin('investigasis','investigasis.id','=','temuans.investigasi_id')
                    ->where('temuans.investigasi_id',$id)
                    ->select('temuans.*','investigasis.status');

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('tanggal', function($row){
                        $tgl = date('d-m-Y', strtotime($row->tanggal));
                        return $tgl;
                    })     
                     ->addColumn('action', function($row){
                        if ($row->status == '0')   
                            return '<a href="javascript:void(0)" id="'.$row->id.'" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled btn-edit-temuan"
                                    data-bs-toggle="tooltip" title="Edit"><i class="fa fa-fw fa-pencil-alt"></i></a>
                                    <a href="javascript:void(0)" id="'.$row->id.'" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled btn-delete-temuan"
                                     data-bs-toggle="tooltip" title="Delete"><i class="fa fa-fw fa-times"></i></a></div>';

                    })
                    ->escapeColumns([])
                    ->make(true);
        }
    }
    // end Temuan

    public function getUangDiselamatkan(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = DB::table('uangdiselamatkans')
                    ->leftjoin('investigasis','investigasis.id','=','uangdiselamatkans.investigasi_id')
                    ->where('uangdiselamatkans.investigasi_id',$id)
                    ->select('uangdiselamatkans.*','investigasis.status');

            return DataTables::of($data)
                    ->addIndexColumn()        
                     ->addColumn('action', function($row){   
                        if ($row->status == '0')   
                        return '<a href="javascript:void(0)" id="'.$row->id.'" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled btn-edit-uangpertanggungan"
                                    data-bs-toggle="tooltip" title="Edit"><i class="fa fa-fw fa-pencil-alt"></i></a>
                                    <a href="javascript:void(0)" id="'.$row->id.'" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled btn-delete-uangpertanggungan"
                                     data-bs-toggle="tooltip" title="Delete"><i class="fa fa-fw fa-times"></i></a></div>';
                    })
                    ->escapeColumns([])
                    ->make(true);
        }
    }

    public function getKesimpulan(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = DB::table('kesimpulans')
                    ->leftjoin('investigasis','investigasis.id','=','kesimpulans.investigasi_id')
                    ->where('kesimpulans.investigasi_id',$id)
                    ->select('kesimpulans.*','investigasis.status')
                    ->orderBy('kesimpulans.id','ASC');

            return DataTables::of($data)
                    ->addIndexColumn()        
                     ->addColumn('action', function($row){
                        if ($row->status == '0')   
                        return  '<a href="javascript:void(0)" id="'.$row->id.'" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled btn-edit-kesimpulan"
                                    data-bs-toggle="tooltip" title="Edit"><i class="fa fa-fw fa-pencil-alt"></i></a>
                            <a href="javascript:void(0)" id="'.$row->id.'" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled btn-delete-kesimpulan"
                                     data-bs-toggle="tooltip" title="Delete"><i class="fa fa-fw fa-times"></i></a></div>';
                    })
                    ->escapeColumns([])
                    ->make(true);
        }
    }

    public function createKesimpulan($id)
    {
        $user_id = Auth::user()->id;
        $data = Investigasi::findOrFail($id)
                    ->join('asuransis','investigasis.asuransi_id','=','asuransis.id')
                    ->join('investigators','investigasis.investigator_id','=','investigators.id')
                    ->select('investigasis.*','asuransis.nm_perusahaan','investigators.nm_investigator')
                    ->where('investigasis.id', $id )
                    ->first();
        return view('kesimpulan.add',compact('data','user_id'));
    }

    public function editKesimpulan($id)
    {
        $user_id = Auth::user()->id;
        $data = Kesimpulan::findOrFail($id);

        return view('kesimpulan.edit',compact('data','user_id'));
    }

    public function addKesimpulan(Request $request){
        Kesimpulan::create($request->all());
    }

    public function delKesimpulan($id){
        Kesimpulan::find($id)->delete();
    }

    public function getIdKesimpulan($id){
        $data = Kesimpulan::find($id);
        return response()->json($data);
    }

    public function updateKesimpulan(Request $request, Kesimpulan $kesimpulan){
        $data = Kesimpulan::find($request->id);
        $data->kesimpulan = $request->kesimpulan;
        $data->save();
    }

    public function getRekomendasi(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = DB::table('rekomendasis')
            ->leftjoin('investigasis','investigasis.id','=','rekomendasis.investigasi_id')
            ->where('rekomendasis.investigasi_id',$id)
            ->select('rekomendasis.*','investigasis.status');

            return DataTables::of($data)
                    ->addIndexColumn()        
                     ->addColumn('action', function($row){
                         if ($row->status == "0")
                        return '<a href="javascript:void(0)" id="'.$row->id.'" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled btn-edit-rekomendasi"
                                    data-bs-toggle="tooltip" title="Edit"><i class="fa fa-fw fa-pencil-alt"></i></a>
                                    <a href="javascript:void(0)" id="'.$row->id.'" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled btn-delete-rekomendasi"
                                    data-bs-toggle="tooltip" title="Delete"><i class="fa fa-fw fa-times"></i></a></div>';
                        
                    })
                    ->escapeColumns([])
                    ->make(true);
        }
    }

    public function addRekomendasi(Request $request){
        Rekomendasi::create($request->all());
    }

    public function delRekomendasi($id){
        Rekomendasi::find($id)->delete();
    }

    public function getIdRekomendasi($id){
        $data = Rekomendasi::find($id);
        return response()->json($data);
    }

    public function updateRekomendasi(Request $request){
        $data = Rekomendasi::find($request->id);
        $data->rekomendasi = $request->rekomendasi;
        $data->save();
        return response()->json($data, 200);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function lastNocase(Request $request)
    {
        if(request()->ajax())
        {
            $asuransi = Asuransi::all();
            $klaim = JenisClaim::all();
            $investigator = Investigator::all();
            $provinsi = Provinsi::all();
            $bulan = date('n');
            $tahun = date ('Y');
            $data = DB::table('investigasis')
                    // ->whereMonth('created_at', '=', $bulan)
                    // ->whereYear('created_at', '=', $tahun)
                    ->orderBy('id', 'desc')->first();
            // $data = Investigasi::max('no_case');
        }

        return response()->json(['data' => $data]);
    }

    public function store(InvestigasiRequest $request)
    {
        $user_id = Auth::user()->id;
        
        //cek no case terakhir->cek kolom number case
        $numbercase = DB::table('investigasis')
                    ->select('investigasis.number_case')
                    ->orderBy('number_case', 'desc')->first();
        
        if ( empty($numbercase) )
            $addnocase = $numbercase + 1;
        
        else
        $addnocase = $numbercase->number_case + 1;
        
     
        


        // Investigasi::create($request->all());
        $investigasi=new Investigasi();

        $investigasi->no_case=$request->no_case;
        $investigasi->number_case=$addnocase;
        $investigasi->tgl_registrasi=$request->tgl_registrasi;
        $investigasi->asuransi_id=$request->asuransi_id;
        $investigasi->no_polis=$request->no_polis;
        $investigasi->nm_tertanggung=$request->nm_tertanggung;
        $investigasi->nm_pemegang_polis=$request->nm_pemegang_polis;
        $investigasi->nm_agen=$request->nm_agen;
        $investigasi->uang_pertanggungan=$request->uang_pertanggungan;
        $investigasi->alamat_provinsi=$request->alamat_provinsi;
        $investigasi->alamat_kabupaten=$request->alamat_kabupaten;
        $investigasi->alamat_kecamatan=$request->alamat_kecamatan;
        $investigasi->alamat_tertanggung=$request->alamat_tertanggung;
        $investigasi->tgl_spaj=$request->tgl_spaj;
        $investigasi->tgl_efektif_polis=$request->tgl_efektif_polis;
        $investigasi->usia_polis=$request->usia_polis;
        $investigasi->pekerjaan=$request->pekerjaan;
        $investigasi->matauang=$request->matauang;
        $investigasi->premi=$request->premi;
        $investigasi->total_premi=$request->total_premi;
        $investigasi->jml_klaim=$request->jml_klaim;
        $investigasi->tempat_meninggal=$request->tempat_meninggal;
        $investigasi->tgl_meninggal=$request->tgl_meninggal;
        $investigasi->diagnosa_utama=$request->diagnosa_utama;
        $investigasi->tgl_dirawat_dr=$request->tgl_dirawat_dr;
        $investigasi->tgl_dirawat_smp=$request->tgl_dirawat_smp;
        $investigasi->jenisclaim_id=$request->jenisclaim_id;
        $investigasi->rumah_sakit=$request->rumah_sakit;
        $investigasi->area_investigasi=$request->area_investigasi;
        $investigasi->provinsi=$request->provinsi;
        $investigasi->kepemilikan_asuransi_lain=$request->kepemilikan_asuransi_lain;
        $investigasi->investigasi_fee=$request->investigasi_fee;
        $investigasi->investigator_id=$request->investigator_id;
        $investigasi->informasi_lain=$request->informasi_lain;
        $investigasi->tgl_kirim_dokumen=$request->tgl_kirim_dokumen;
        $investigasi->tambahan_waktu=$request->tambahan_waktu;
        $investigasi->pengaju_klaim=$request->pengaju_klaim;
        $investigasi->kronologi_singkat=$request->kronologi_singkat;
        $investigasi->metode_investigasi=$request->metode_investigasi;
        $investigasi->agen_terlibat=$request->agen_terlibat;
        $investigasi->plan=$request->plan;
        $investigasi->status=0;
        $investigasi->user_id=$user_id;
        $investigasi->save();

        return redirect()->route('investigasi')->with('success','Data berhasil disimpan!');
    }



    public function getKabupaten(Request $request){
        $kabupaten = Kabupaten::where('provinsi_id', $request->get('provinsi_id'))
                  ->get();
        return response()->JSON($kabupaten);
    }

    public function getKecamatan(Request $request){
        $kecamatan = Kecamatan::where('kabupaten_id', $request->get('kabupaten_id'))
                  ->get();
        return response()->JSON($kecamatan);
    }

    public function registrasi(Request $request)
    {
        $asuransi = Asuransi::all();
        $matauang = Matauang::all();
        $klaim = JenisClaim::all();
        $investigator = Investigator::all();
        $provinsi = Provinsi::all();
        $kabupaten = Kabupaten::all();
        $kecamatan = Kecamatan::all();
        $user_id = Auth::user()->id;
        $user_name = Auth::user()->name;
        return view('investigasi.registrasi',compact('asuransi','matauang','klaim','investigator','provinsi',
        'kabupaten','kecamatan','user_id','user_name'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $kategori = KategoriInvestigasi::all();
        $user = Auth::user();
        $asuransi = Asuransi::all();
        $detail = Investigasi::find($id)
                ->leftjoin('asuransis','investigasis.asuransi_id','=','asuransis.id')
                ->leftjoin('investigators','investigasis.investigator_id','=','investigators.id')
                ->leftjoin('jenis_claims','investigasis.jenisclaim_id','=','jenis_claims.id')
                ->leftjoin('users','investigasis.user_id','=','users.id')
                ->leftjoin('provinsis','investigasis.alamat_provinsi','=','provinsis.id')
                ->leftjoin('kabupatens','investigasis.alamat_kabupaten','=','kabupatens.id')
                ->leftjoin('kecamatans','investigasis.alamat_kecamatan','=','kecamatans.id')
                ->select('investigasis.*','asuransis.id as asuransi_id','asuransis.nm_perusahaan',
                         'asuransis.kd_perusahaan','investigators.id as investigator_id',
                         'investigators.nm_investigator','jenis_claims.id as jenisklaim_id',
                         'jenis_claims.jenis_klaim','users.name as username','provinsis.provinsi',
                         'kabupatens.kabupaten','kecamatans.kecamatan')
                ->where('investigasis.id', $id )
                ->first();

        return view('investigasi.detail',compact('detail','asuransi','user'));
    }


    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $asuransi = Asuransi::all();
        $matauang = Matauang::all();
        $klaim = JenisClaim::all();
        $investigator = Investigator::all();
        $provinsi = Provinsi::all();
        $kabupaten = Kabupaten::all();
        $kecamatan = Kecamatan::all();
        $detail = Investigasi::find($id)
        ->leftjoin('asuransis','investigasis.asuransi_id','=','asuransis.id')
        ->leftjoin('investigators','investigasis.investigator_id','=','investigators.id')
        ->leftjoin('jenis_claims','investigasis.jenisclaim_id','=','jenis_claims.id')
        ->leftjoin('provinsis','investigasis.alamat_provinsi','=','provinsis.id')
        ->leftjoin('kabupatens','investigasis.alamat_kabupaten','=','kabupatens.id')
        ->leftjoin('kecamatans','investigasis.alamat_kecamatan','=','kecamatans.id')
        ->select('investigasis.*','asuransis.id as asuransi_id','asuransis.nm_perusahaan',
                 'asuransis.kd_perusahaan','investigators.id as inestigator_id',
                 'investigators.nm_investigator','jenis_claims.id as jenisklaim_id',
                 'jenis_claims.jenis_klaim','provinsis.provinsi',
                 'kabupatens.kabupaten','kecamatans.kecamatan')
        ->where('investigasis.id', $id )
        ->first();

        return view('investigasi.edit',compact('asuransi','matauang','klaim','investigator','provinsi'
        ,'kabupaten','kecamatan','detail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Investigasi $investigasi)
    {
        $investigasi->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Investigasi::find($id)->delete();
    }

    public function sendApprove($id)
    {
        if(request()->ajax()) {
            $data = Investigasi::FindOrFail($id)->first();
            return response()->json(['data'=>$data]);
        }
    }

    public function notApprove($id)
    {
        
    }

    public function updateSendApprove(Request $request, Investigasi $investigasi)
    {
        $data = Investigasi::find($request->id);
        $data->status = $request->status;
        $data->user_id_approve = $request->user_id_approve;
        $data->save();
        return response()->json($data, 200);
    }

    public function updateSentDocument(Request $request, Investigasi $investigasi)
    {
        $data = Investigasi::find($request->id);
        $data->status_sent_client = $request->status_sent_client;
        $data->save();
        return response()->json($data, 200);
    }

    


    public function generate($id)
    {
        $asuransi = Asuransi::all();
        $detail = Investigasi::find($id)
                ->join('asuransis','investigasis.asuransi_id','=','asuransis.id')
                ->join('investigators','investigasis.investigator_id','=','investigators.id')
                ->join('jenis_claims','investigasis.jenisclaim_id','=','jenis_claims.id')
                ->select('investigasis.*','asuransis.id as asuransi_id','asuransis.nm_perusahaan',
                         'asuransis.kd_perusahaan','investigators.id as investigator_id',
                         'investigators.nm_investigator','jenis_claims.id as jenisklaim_id','jenis_claims.jenis_klaim')
                ->where('investigasis.id', $id )
                ->first();

         $data = Investigasi::findOrFail($id)
                ->join('asuransis','investigasis.asuransi_id','=','asuransis.id')
                ->join('investigators','investigasis.investigator_id','=','investigators.id')
                ->join('updateinvestigasis','investigasis.id','=','updateinvestigasis.investigasi_id')
                ->join('kategori_investigasis','kategori_investigasis.id','=','updateinvestigasis.kategoriinvestigasi_id')
                ->select('updateinvestigasis.*','updateinvestigasis.id as id_upin','kategori_investigasis.*')
                ->where('investigasis.id', $id )
                ->get();
                
        $kategori = DB::table('updateinvestigasis as u')
                ->join('kategori_investigasis as k','k.id','=','u.kategoriinvestigasi_id')
                ->select('k.*')
                ->where('u.investigasi_id', $id )
                ->groupBy('k.id')
                ->get();

        $masihdalamproses = DB::table('proses_kesimpulan_sementaras as pks')
                          ->select('pks.*')
                          ->where('pks.investigasi_id',$id)
                          ->where('pks.flag','Proses Dilakukan')
                          ->get();

        $kesimpulansementara = DB::table('proses_kesimpulan_sementaras as pks')
                            ->select('pks.*')
                            ->where('pks.investigasi_id',$id)
                            ->where('pks.flag','Kesimpulan Sementara')
                            ->get();

                $pdf = PDF::loadview('investigasi.generate_report_sementara',
                compact('asuransi','detail','data','kategori','masihdalamproses','kesimpulansementara'))
                // compact('asuransi','detail','data','kategori','foto','rekomendasi','kesimpulan'))
        ->setPaper('letter','potrait');
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();

        $canvas = $dom_pdf ->get_canvas();
        $canvas->page_text(250, 800, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
        return $pdf->stream('laporan_investigasi_sementara.pdf');

    }

    public function printWorksheet($id)
    {
        
        $detail = Investigasi::find($id)
                ->leftjoin('asuransis','investigasis.asuransi_id','=','asuransis.id')
                ->leftjoin('investigators','investigasis.investigator_id','=','investigators.id')
                ->leftjoin('jenis_claims','investigasis.jenisclaim_id','=','jenis_claims.id')
                ->leftjoin('provinsis','investigasis.alamat_provinsi','=','provinsis.id')
                ->leftjoin('kabupatens','investigasis.alamat_kabupaten','=','kabupatens.id')
                ->leftjoin('kecamatans','investigasis.alamat_kecamatan','=','kecamatans.id')
                ->select('investigasis.*','asuransis.id as asuransi_id','asuransis.nm_perusahaan',
                         'asuransis.kd_perusahaan','investigators.id as investigator_id',
                         'investigators.nm_investigator','jenis_claims.id as jenisklaim_id',
                         'jenis_claims.jenis_klaim','provinsis.provinsi as provinsi_alamat',
                         'kabupatens.kabupaten','kecamatans.kecamatan')
                ->where('investigasis.id', $id )
                ->first();

         $data = Investigasi::findOrFail($id)
                ->join('asuransis','investigasis.asuransi_id','=','asuransis.id')
                ->join('investigators','investigasis.investigator_id','=','investigators.id')
                ->join('updateinvestigasis','investigasis.id','=','updateinvestigasis.investigasi_id')
                ->join('kategori_investigasis','kategori_investigasis.id','=','updateinvestigasis.kategoriinvestigasi_id')
                ->select('updateinvestigasis.*','updateinvestigasis.id as id_upin','kategori_investigasis.*')
                ->where('investigasis.id', $id )
                ->get();
                
        

                $pdf = PDF::loadview('investigasi.print_worksheet',
                compact('detail','data'))
                // compact('asuransi','detail','data','kategori','foto','rekomendasi','kesimpulan'))
        ->setPaper('letter','potrait');
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();

        $canvas = $dom_pdf ->get_canvas();
        $canvas->page_text(250, 800, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
        return $pdf->stream('print_worksheet.pdf');

    }

    public function generateAkhir($id)
    {
        $asuransi = Asuransi::all();
        $detail = Investigasi::find($id)
                ->leftjoin('asuransis','investigasis.asuransi_id','=','asuransis.id')
                ->leftjoin('investigators','investigasis.investigator_id','=','investigators.id')
                ->leftjoin('jenis_claims','investigasis.jenisclaim_id','=','jenis_claims.id')
                ->leftjoin('provinsis','investigasis.alamat_provinsi','=','provinsis.id')
                ->leftjoin('kabupatens','investigasis.alamat_kabupaten','=','kabupatens.id')
                ->leftjoin('kecamatans','investigasis.alamat_kecamatan','=','kecamatans.id')
                ->select('investigasis.*','asuransis.id as asuransi_id','asuransis.nm_perusahaan',
                         'asuransis.kd_perusahaan','investigators.id as investigator_id',
                         'investigators.nm_investigator','jenis_claims.id as jenisklaim_id',
                         'jenis_claims.jenis_klaim','provinsis.provinsi as provinsi_alamat',
                         'kabupatens.kabupaten','kecamatans.kecamatan')
                ->where('investigasis.id', $id )
                ->first();

        $data = Investigasi::findOrFail($id)
                ->join('asuransis','investigasis.asuransi_id','=','asuransis.id')
                ->join('investigators','investigasis.investigator_id','=','investigators.id')
                ->join('updateinvestigasis','investigasis.id','=','updateinvestigasis.investigasi_id')
                ->join('kategori_investigasis','kategori_investigasis.id','=','updateinvestigasis.kategoriinvestigasi_id')
                ->select('updateinvestigasis.*','updateinvestigasis.id as id_upin','kategori_investigasis.*')
                ->where('investigasis.id', $id )
                ->get();
        // dd($data);
        // DB::enableQueryLog() ;
        $kategori = DB::table('updateinvestigasis as u')
                    ->join('kategori_investigasis as k','k.id','=','u.kategoriinvestigasi_id')
                    ->select('u.tanggal','u.kategoriinvestigasi_id','k.kategori_investigasi')
                    ->where('u.investigasi_id', $id )
                    ->groupBy('u.kategoriinvestigasi_id')
                    ->orderBy('u.tanggal','asc')
                    ->get();
        // dd($kategori);
        // dd(DB::enableQueryLog());
        $foto =  DB::table('updateinvestigasis as u')
                    ->join('foto_investigasis as f','u.id','=','f.updateinvestigasi_id')
                    ->select('u.*','f.*')
                    ->where('u.investigasi_id', $id )
                    ->get();

        // dd($foto);
        // 
        // rekomendasi
        $rekomendasi = DB::table('rekomendasis')
        ->where('rekomendasis.investigasi_id',$id)
        ->get();
        
        //kesimpulan
        $kesimpulan = DB::table('kesimpulans')
        ->where('kesimpulans.investigasi_id',$id)
        ->get();

        //kesimpulan
        $pendalaman = DB::table('pendalaman_investigasis as p')
        ->where('p.investigasi_id',$id)
        ->get();

        //KategoriCount
        $kategoriInvest = DB::table('updateinvestigasis')
        ->leftjoin('kategori_investigasis','kategori_investigasis.id','=','updateinvestigasis.kategoriinvestigasi_id')
        ->where('updateinvestigasis.investigasi_id',$id)
        ->distinct()
        ->get();

        $polislain = DB::table('polislains')
                    ->leftjoin('asuransis','polislains.asuransi_id','=','asuransis.id')
                    ->where('polislains.investigasi_id',$id)
                    ->select('polislains.*','asuransis.nm_perusahaan')
                    ->get();

        $lampiran = DB::table('lampiran_fotos')
                    ->where('investigasi_id',$id)
                    ->select('*')
                    ->get();

        $pdf = PDF::loadview('investigasi.generate_report_akhir',
                compact('asuransi','detail','data','kategori','foto','rekomendasi',
                        'kesimpulan','kategoriInvest','polislain','pendalaman','lampiran'))
        ->setPaper('letter','potrait');
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();

        $canvas = $dom_pdf ->get_canvas();
        $canvas->page_text(250, 800, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
    	return $pdf->stream('laporan-akhir-investigasi.pdf');
    }
}
