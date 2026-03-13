<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelianceFieldsToInvestigasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('investigasis', function (Blueprint $table) {
            $table->string('nama_peserta', 100)->nullable();
            $table->string('nomor_peserta', 50)->nullable();
            $table->date('tgl_mulai')->nullable();
            $table->date('tgl_pengajuan')->nullable();
            $table->date('tgl_selesai')->nullable();
            $table->date('tgl_klaim')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('investigasis', function (Blueprint $table) {
            $table->dropColumn(['nama_peserta', 'nomor_peserta', 'tgl_mulai', 'tgl_pengajuan', 'tgl_selesai', 'tgl_klaim']);
        });
    }
}
