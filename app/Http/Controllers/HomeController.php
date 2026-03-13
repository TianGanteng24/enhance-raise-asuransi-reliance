<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        
        // 1. Inisialisasi nilai default agar tidak undefined
        $onGoing = 0;
        $complete = 0;
        $wait = 0;
        $client = 0;
        $clientview = collect(); // Menggunakan collection kosong

        // 2. Gunakan query builder dasar
        $query = DB::table('investigasis');

        // 3. Jika role adalah user, batasi data hanya miliknya
        // Jika master/spv, biarkan query mengambil semua data
        if ($user->role == 'user') {
            $query->where('investigasis.user_id', $user->id);
        }

        // Pastikan role valid sebelum eksekusi query
        if (in_array($user->role, ['master', 'spv', 'user'])) {
            
            // Hitung Ongoing (status 0)
            $onGoing = (clone $query)->where('status', 0)->count();

            // Hitung Complete (status 1)
            $complete = (clone $query)->where('status', 1)->count();

            // Hitung Wait (status 2)
            $wait = (clone $query)->where('status', 2)->count();

            // Hitung Total Client (Distinct asuransi_id)
            $client = (clone $query)->distinct('asuransi_id')->count('asuransi_id');

            // Ambil List Client untuk View
            $clientview = (clone $query)
                ->leftJoin('asuransis', 'asuransis.id', '=', 'investigasis.asuransi_id')
                ->select('investigasis.asuransi_id', 'asuransis.nm_perusahaan')
                ->distinct()
                ->get();
        }

        return view('dashboard', compact('user', 'onGoing', 'complete', 'wait', 'client', 'clientview'));
    }
}