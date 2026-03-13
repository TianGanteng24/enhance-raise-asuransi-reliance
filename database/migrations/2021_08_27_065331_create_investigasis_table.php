<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestigasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investigasis', function (Blueprint $table) {
            $table->id();
            $table->string('no_case',50);
            $table->date('tgl_registrasi');
            $table->unsignedBigInteger('asuransi_id');
            $table->string('no_polis',50);
            $table->string('nm_tertanggung',100);
            $table->string('nm_pemegang_polis',100);
            $table->string('nm_agen',100);
            $table->string('alamat_tertanggung',191);
            $table->date('tgl_spaj');
            $table->date('tgl_efektif_polis');
            $table->string('usia_polis',191);
            $table->string('pekerjaan',191);
            $table->string('matauang',10);
            $table->integer('premi');
            $table->integer('total_premi');
            $table->string('tempat_meninggal',191);
            $table->date('tgl_meninggal');
            $table->string('diagnosa_utama',191);
            $table->date('tgl_dirawat_dr');
            $table->date('tgl_dirawat_smp');
            $table->unsignedBigInteger('jenisclaim_id');
            $table->string('rumah_sakit',191);
            $table->string('area_investigasi',191);
            $table->string('provinsi',191);
            $table->string('kepemilikan_asuransi_lain',191);
            $table->integer('investigasi_fee');
            $table->unsignedBigInteger('investigator_id');
            $table->string('informasi_lain');
            $table->date('tgl_kirim_dokumen');
            $table->string('tambahan_waktu');
            $table->string('pengaju_klaim');
            $table->longText('kronologi_singkat');
            $table->unsignedBigInteger('user_id');
            $table->integer('status');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('asuransi_id')->references('id')->on('asuransis')->onDelete('restrict');
            $table->foreign('jenisclaim_id')->references('id')->on('jenis_claims')->onDelete('restrict');
            $table->foreign('investigator_id')->references('id')->on('investigators')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('investigasis');
    }
}
