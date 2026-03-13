<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Example Routes
// Route::view('/', 'landing');
Route::view('/', 'auth/login');
Route::match(['get', 'post'], '/dashboard', function(){
    return view('dashboard');
});
Route::view('/pages/slick', 'pages.slick');
Route::view('/pages/datatables', 'pages.datatables');
Route::view('/pages/blank', 'pages.blank');
// Auth::routes();

Auth::routes([

    'register' => false, // Register Routes...
  
    'reset' => false, // Reset Password Routes...
  
    'verify' => false, // Email Verification Routes...
  
  ]);

Route::resource('jenisklaim','\App\Http\Controllers\JenisClaimController');
Route::resource('polislain','\App\Http\Controllers\PolisLainController');
Route::resource('user','\App\Http\Controllers\UserController');
Route::resource('pendalaman','\App\Http\Controllers\PendalamanController');
Route::resource('proseskesimpulanSMT','\App\Http\Controllers\ProsesKesimpulanSementaraController');

Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');
Route::post('/changePassword', [App\Http\Controllers\UserController::class, 'changePassword'])->name('changePassword');

Route::resource('asuransi','\App\Http\Controllers\AsuransiController');
Route::resource('matauang','\App\Http\Controllers\MatauangController');
Route::resource('investigator','\App\Http\Controllers\InvestigatorController');
Route::resource('kategoriinvestigasi','\App\Http\Controllers\KategoriInvestigasiController');
Route::resource('updateinvestigasi','\App\Http\Controllers\UpdateInvestigasiController');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/jenisclaim', [App\Http\Controllers\JenisClaimController::class, 'index'])->name('jenisclaim');
Route::post('/jenisklaim/store', [App\Http\Controllers\JenisClaimController::class, 'store'])->name('jenisklaim/store');
Route::delete('/jenisklaim/destroy/{id}', [App\Http\Controllers\JenisClaimController::class, 'destroy'])->name('jenisklaim/destroy');

Route::get('/asuransi', [App\Http\Controllers\AsuransiController::class, 'index'])->name('asuransi');

Route::get('/generate/{id}', [App\Http\Controllers\InvestigasiController::class, 'generate'])->name('generate');
Route::get('/printWorksheet/{id}', [App\Http\Controllers\InvestigasiController::class, 'printWorksheet'])->name('printWorksheet');

Route::resource('investigasi','\App\Http\Controllers\InvestigasiController');
Route::get('/getKabupaten',[App\Http\Controllers\InvestigasiController::class, 'getKabupaten'])->name('getKabupaten');
Route::get('/getKecamatan',[App\Http\Controllers\InvestigasiController::class, 'getKecamatan'])->name('getKecamatan');
Route::get('/investigasi', [App\Http\Controllers\InvestigasiController::class, 'index'])->name('investigasi');
Route::get('/registrasi', [App\Http\Controllers\InvestigasiController::class, 'registrasi'])->name('registrasi');
Route::get('/investigasi/{id}/detail', [App\Http\Controllers\InvestigasiController::class, 'show'])->name('detail');
Route::get('/getdetail/{id}', [App\Http\Controllers\InvestigasiController::class, 'getDetailUpdate'])->name('getdetail');
Route::get('/lastnocase', [App\Http\Controllers\InvestigasiController::class, 'lastnocase'])->name('lastnocase');
// Route::get('/getpolis/{id}', [App\Http\Controllers\PolislainController::class, 'show'])->name('getpolis');
Route::get('/getpolis/{id}', [App\Http\Controllers\InvestigasiController::class, 'getPolis'])->name('getpolis');

Route::get('/getkesimpulan/{id}', [App\Http\Controllers\InvestigasiController::class, 'getKesimpulan'])->name('getkesimpulan');
Route::get('/createkesimpulan/{id}', [App\Http\Controllers\InvestigasiController::class, 'createKesimpulan'])->name('createkesimpulan');
Route::get('/editkesimpulan/{id}', [App\Http\Controllers\InvestigasiController::class, 'editKesimpulan'])->name('editkesimpulan');
Route::post('/addkesimpulan', [App\Http\Controllers\InvestigasiController::class, 'addKesimpulan'])->name('addkesimpulan');
Route::delete('/delkesimpulan/{id}', [App\Http\Controllers\InvestigasiController::class, 'delKesimpulan'])->name('delKesimpulan');
Route::patch('/updatekesimpulan/{id}', [App\Http\Controllers\InvestigasiController::class, 'updateKesimpulan'])->name('updatekesimpulan');
Route::get('/getidkesimpulan/{id}', [App\Http\Controllers\InvestigasiController::class, 'getIdKesimpulan'])->name('getidkesimpulan');

Route::get('/getrekomendasi/{id}', [App\Http\Controllers\InvestigasiController::class, 'getRekomendasi'])->name('getrekomendasi');
Route::post('/addrekomendasi', [App\Http\Controllers\InvestigasiController::class, 'addRekomendasi'])->name('addrekomendasi');
Route::delete('/delrekomendasi/{id}', [App\Http\Controllers\InvestigasiController::class, 'delRekomendasi'])->name('delrekomendasi');
Route::patch('/updaterekomendasi/{id}', [App\Http\Controllers\InvestigasiController::class, 'updateRekomendasi'])->name('updaterekomendasi');
Route::get('/getidrekomendasi/{id}', [App\Http\Controllers\InvestigasiController::class, 'getIdRekomendasi'])->name('getidrekomendasi');

Route::get('/getlampiran/{id}', [App\Http\Controllers\InvestigasiController::class, 'getLampiran'])->name('getlampiran');


Route::get('/getuangdiselamatkan/{id}', [App\Http\Controllers\InvestigasiController::class, 'getUangDiselamatkan'])->name('getuangdiselamatkan');
Route::post('/adduangpertanggungan', [App\Http\Controllers\UangPertanggunganContorller::class, 'addUangPertanggungan'])->name('adduangpertanggungan');
Route::delete('/deluangpertanggungan/{id}', [App\Http\Controllers\UangPertanggunganContorller::class, 'delUangPertanggungan'])->name('deluangpertanggungan');
Route::patch('/updateuangpertanggungan/{id}', [App\Http\Controllers\UangPertanggunganContorller::class, 'updateUangPertanggungan'])->name('updateuangpertanggungan');
Route::get('/getiduangpertanggungan/{id}', [App\Http\Controllers\UangPertanggunganContorller::class, 'getIdUangPertanggungan'])->name('getiduangpertanggungan');

Route::get('/gettemuan/{id}', [App\Http\Controllers\InvestigasiController::class, 'getTemuan'])->name('gettemuan');
Route::post('/addtemuan', [App\Http\Controllers\TemuanContorller::class, 'addTemuan'])->name('addtemuan');
Route::delete('/deltemuan/{id}', [App\Http\Controllers\TemuanContorller::class, 'delTemuan'])->name('deltemuan');
Route::patch('/updatetemuan/{id}', [App\Http\Controllers\TemuanContorller::class, 'updateTemuan'])->name('updatetemuan');
Route::get('/getidtemuan/{id}', [App\Http\Controllers\TemuanContorller::class, 'getIdTemuan'])->name('getidtemuan');

Route::get('/sendApprove/{id}', [App\Http\Controllers\InvestigasiController::class, 'sendApprove'])->name('sendApprove');
Route::get('/notApprove/{id}', [App\Http\Controllers\InvestigasiController::class, 'notApprove'])->name('notApprove');
Route::patch('/editsendApprove/{id}', [App\Http\Controllers\InvestigasiController::class, 'updateSendApprove'])->name('editsendApprove');

Route::patch('/sentDocument/{id}', [App\Http\Controllers\InvestigasiController::class, 'updateSentDocument'])->name('sentDocument');

Route::get('/investigator', [App\Http\Controllers\InvestigatorController::class, 'index'])->name('investigator');
Route::get('/kategoriinvestigasi', [App\Http\Controllers\KategoriInvestigasiController::class, 'index'])->name('kategoriinvestigasi');

Route::post('/upload', [App\Http\Controllers\UpdateInvestigasiController::class, 'upload'])->name('upload');
Route::get('/viewimg/{id}', [App\Http\Controllers\UpdateInvestigasiController::class, 'viewImg'])->name('viewimg');
Route::delete('/destroyimg/{id}', [App\Http\Controllers\UpdateInvestigasiController::class, 'destroyImg'])->name('destroyimg');

// Route::get('/investigasi/generate/', [App\Http\Controllers\InvestigasiController::class, 'generateAkhir'])->name('generateakhir');

Route::get('/investigasi/generate/{id}', [App\Http\Controllers\InvestigasiController::class, 'generateAkhir']);
Route::get('/getongoing', [App\Http\Controllers\InvestigasiController::class, 'getOnGoing'])->name('getOnGoing');
Route::get('/waitapprove', [App\Http\Controllers\InvestigasiController::class, 'waitApprove'])->name('waitApprove');
Route::get('/complete', [App\Http\Controllers\InvestigasiController::class, 'complete'])->name('complete');

//report
Route::get('/pendingcase', [App\Http\Controllers\ReportController::class, 'pendingCase'])->name('pendingCase');
Route::get('/printpendingcase/{dr_tgl}/{smp_tgl}/{asuransi_id}', [App\Http\Controllers\ReportController::class, 'printPendingCase'])->name('printpendingcase');

Route::get('/portofolio', [App\Http\Controllers\ReportController::class, 'portofolio'])->name('portofolio');
Route::get('/printportofolio/{dr_tgl}/{smp_tgl}/{asuransi_id}', [App\Http\Controllers\ReportController::class, 'printPortofolio'])->name('printportofolio');

Route::get('/management', [App\Http\Controllers\ReportController::class, 'management'])->name('management');
Route::get('/printmanagement/{dr_tgl}/{smp_tgl}/{asuransi_id}', [App\Http\Controllers\ReportController::class, 'printManagement'])->name('printmanagement');

Route::get('/getlampiranfoto/{id}', [App\Http\Controllers\LampiranController::class, 'getLampiranFoto'])->name('getlampiranfoto');
Route::post('/uploadlampiran', [App\Http\Controllers\LampiranController::class, 'uploadLampiran'])->name('uploadlampiran');
Route::delete('/dellampiranfoto/{id}', [App\Http\Controllers\LampiranController::class, 'delLampiranFoto'])->name('dellampiranfoto');
Route::get('/getidlampiranfoto/{id}', [App\Http\Controllers\LampiranController::class, 'getIdLampiranFoto'])->name('getidlampiranfoto');

//reset pass
Route::patch('/reset/{id}', [App\Http\Controllers\UserController::class, 'reset'])->name('reset');