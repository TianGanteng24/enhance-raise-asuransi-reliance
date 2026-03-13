<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProsesKesimpulanSementarasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proses_kesimpulan_sementaras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('investigasi_id');
            $table->string('flag'); 
            $table->string('proses_kesimpulan_sementara');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proses_kesimpulan_sementaras');
    }
}
