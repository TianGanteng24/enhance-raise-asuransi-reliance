<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investigasi;
use App\Models\KategoriInvestigasi;
use App\Models\Updateinvestigasi;
use App\Models\Investigator;
use App\Models\Asuransi;
use App\Models\JenisClaim;
use App\Models\Provinsi;
use App\Models\Kesimpulan;
use App\Models\Rekomendasi;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Auth;
use PDF;

class ReportController extends Controller
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

    public function pendingCase(Request $request)
    {
        $user_id = Auth::user();
        $asuransi=Asuransi::all();
        $data = [];
        if (($user_id->role =='master' or $user_id->role =='spv')){
            if ($request->ajax()) {
                if($request->dr_tgl != '' && $request->smp_tgl != '')
                {
                    $data = DB::table('investigasis')
                            ->join('investigators','investigasis.investigator_id','=','investigators.id')
                            ->join('jenis_claims','investigasis.jenisclaim_id','=','jenis_claims.id')
                            ->select('investigasis.*','investigators.*','jenis_claims.*')
                            ->where('asuransi_id',$request->asuransi)
                            ->where('status','0')
                            ->whereBetween('tgl_registrasi', array($request->dr_tgl, $request->smp_tgl))
                            ->get();
                }else{
                    $data = [];
                }
            
                return DataTables::of($data)
                        ->addIndexColumn()
                        ->escapeColumns([])
                        ->make(true);
            }
        }

        if (($user_id->role =='user')){
            if ($request->ajax()) {
                if($request->dr_tgl != '' && $request->smp_tgl != '')
                {
                    $data = DB::table('investigasis')
                            ->join('investigators','investigasis.investigator_id','=','investigators.id')
                            ->join('jenis_claims','investigasis.jenisclaim_id','=','jenis_claims.id')
                            ->select('investigasis.*','investigators.*','jenis_claims.*')
                            ->where('asuransi_id',$request->asuransi)
                            ->where('status','0')
                            ->where('investigasis.user_id',$user_id->id)
                            ->whereBetween('tgl_registrasi', array($request->dr_tgl, $request->smp_tgl))
                            ->get();
                }else{
                    $data = [];
                }
            
                return DataTables::of($data)
                        ->addIndexColumn()
                        ->escapeColumns([])
                        ->make(true);
            }
        }
        return view('reporting.pendingcase',compact('asuransi'));
    }

    public function printPendingCase(Request $request,$dr_tgl,$smp_tgl,$asuransi_id)
    {
        $user_id = Auth::user();
        $asuransi=Asuransi::all();
        $data = [];
        $tgl1 = $dr_tgl;
        $tgl2 = $smp_tgl;
        
        if (($user_id->role =='master' or $user_id->role =='spv')){
            if($dr_tgl != '' && $smp_tgl != '' &&  $asuransi_id != '')
            {
                $data = DB::table('investigasis')
                        ->join('investigators','investigasis.investigator_id','=','investigators.id')
                        ->join('jenis_claims','investigasis.jenisclaim_id','=','jenis_claims.id')
                        ->select('investigasis.*','investigators.*','jenis_claims.*')
                        ->where('status',0)
                        ->where('asuransi_id',$asuransi_id)
                        ->whereBetween('tgl_registrasi', array($dr_tgl, $smp_tgl))
                        ->get();
                $peru = DB::table('asuransis')
                ->select('*')
                ->where('id',$asuransi_id)
                ->first();
                
            }else{
                $data = [];
            }
        }

        if (($user_id->role =='user')){
            if($dr_tgl != '' && $smp_tgl != '' &&  $asuransi_id != '')
            {
                $data = DB::table('investigasis')
                        ->join('investigators','investigasis.investigator_id','=','investigators.id')
                        ->join('jenis_claims','investigasis.jenisclaim_id','=','jenis_claims.id')
                        ->select('investigasis.*','investigators.*','jenis_claims.*')
                        ->where('status',0)
                        ->where('asuransi_id',$asuransi_id)
                        ->where('investigasis.user_id',$user_id->id)
                        ->whereBetween('tgl_registrasi', array($dr_tgl, $smp_tgl))
                        ->get();
                $peru = DB::table('asuransis')
                ->select('*')
                ->where('id',$asuransi_id)
                ->first();
                
            }else{
                $data = [];
            }
        }

        $pdf = PDF::loadview('reporting.report-pandingcase',
                compact('data','tgl1','tgl2','peru'))
                ->setPaper('letter','landscape');
                return $pdf->stream('laporan_pending_investigasi');
    }

    public function portofolio(Request $request)
    {
        $asuransi=Asuransi::all();
        $data = [];
        if ($request->ajax()) {
            if($request->dr_tgl != '' && $request->smp_tgl != '')
            {
                $data = DB::table('investigasis')
                        ->join('investigators','investigasis.investigator_id','=','investigators.id')
                        ->join('jenis_claims','investigasis.jenisclaim_id','=','jenis_claims.id')
                        ->select('investigasis.*','investigators.*','jenis_claims.*')
                        ->where('asuransi_id',$request->asuransi)
                        ->whereBetween('tgl_registrasi', array($request->dr_tgl, $request->smp_tgl))
                        ->get();
            }else{
                $data = [];
            }
          
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->escapeColumns([])
                    ->make(true);
        }
        return view('reporting.portofolio',compact('asuransi'));
    }

    public function printPortofolio(Request $request,$dr_tgl,$smp_tgl,$asuransi_id)
    {
        $asuransi=Asuransi::all();
        $data = [];
        $tgl1 = $dr_tgl;
        $tgl2 = $smp_tgl;
        
            if($dr_tgl != '' && $smp_tgl != '' &&  $asuransi_id != '')
            {
                $data = DB::table('investigasis')
                        ->join('investigators','investigasis.investigator_id','=','investigators.id')
                        ->join('jenis_claims','investigasis.jenisclaim_id','=','jenis_claims.id')
                        ->select('investigasis.*','investigators.*','jenis_claims.*')
                        ->where('asuransi_id',$asuransi_id)
                        ->whereBetween('tgl_registrasi', array($dr_tgl, $smp_tgl))
                        ->get();
                $peru = DB::table('asuransis')
                        ->select('*')
                        ->where('id',$asuransi_id)
                        ->first();
            }else{
                $data = [];
            }

        $pdf = PDF::loadview('reporting.report-portofolio',
                compact('data','tgl1','tgl2','peru'))
                ->setPaper('letter','landscape');
                return $pdf->stream('laporan_pending_investigasi');
    }

    public function management(Request $request)
    {
        $asuransi=Asuransi::all();
        if ($request->ajax()) {
            if($request->dr_tgl != '' && $request->smp_tgl != '')
            {
            $data = DB::select("SELECT
                                i.*,
                                COUNT(i.id) as tot_kasus,
                                COUNT(t.id) as tot_temuan,
                                COUNT(i.asuransi_id) - COUNT(t.id) as tidak_ada_temuan,
                                COUNT(i.agen_terlibat='Terlibat') as agen,
                                0 AS insurance_shop,
                                SUM(i.uang_pertanggungan) as uang_per,
                                SUM(u.nominal) as uang_selamat
                                FROM investigasis as i
                                LEFT JOIN temuans as t on i.id = t.investigasi_id
                                LEFT JOIN uangdiselamatkans as u on i.id = u.investigasi_id
                                WHERE i.asuransi_id = $request->asuransi AND tgl_registrasi 
                                BETWEEN '$request->dr_tgl' AND '$request->smp_tgl'
                                GROUP BY i.asuransi_id
            ");
            }else{
                $data = [];
            }
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->escapeColumns([])
                    ->make(true);
        }
        return view('reporting.management',compact('asuransi'));
    }

    public function printManagement(Request $request,$dr_tgl,$smp_tgl,$asuransi_id)
    {
        $asuransi=Asuransi::all();
        $data = [];
        $tgl1 = $dr_tgl;
        $tgl2 = $smp_tgl;
        
            if($dr_tgl != '' && $smp_tgl != '' &&  $asuransi_id != '')
            {
                $data = DB::select("SELECT
                                    i.*,
                                    COUNT(i.id) as tot_kasus,
                                    COUNT(t.id) as tot_temuan,
                                    COUNT(i.asuransi_id) - COUNT(t.id) as tidak_ada_temuan,
                                    COUNT(i.agen_terlibat='Terlibat') as agen,
                                    0 AS insurance_shop,
                                    SUM(i.uang_pertanggungan) as uang_per,
                                    SUM(u.nominal) as uang_selamat
                                    FROM investigasis as i
                                    LEFT JOIN temuans as t on i.id = t.investigasi_id
                                    LEFT JOIN uangdiselamatkans as u on i.id = u.investigasi_id
                                    WHERE i.asuransi_id = $asuransi_id AND tgl_registrasi 
                                    BETWEEN '$dr_tgl' AND '$smp_tgl'
                                    GROUP BY i.asuransi_id");

                $peru = DB::table('asuransis')
                        ->select('*')
                        ->where('id',$asuransi_id)
                        ->first();
            }else{
                $data = [];
            }

        $pdf = PDF::loadview('reporting.report-management',
                compact('data','tgl1','tgl2','peru'))
                ->setPaper('letter','landscape');
                return $pdf->stream('laporan_pending_investigasi');
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
        //
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
    public function destroy($id)
    {
        //
    }
}
