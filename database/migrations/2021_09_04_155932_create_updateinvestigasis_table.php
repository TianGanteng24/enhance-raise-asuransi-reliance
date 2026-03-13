<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpdateinvestigasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('updateinvestigasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('investigasi_id');
            $table->unsignedBigInteger('kategoriinvestigasi_id');
            $table->date('tanggal');
            $table->longtext('update_investigasi');
            $table->string('foto');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('investigasi_id')->references('id')->on('investigasis')->onDelete('restrict');
            $table->foreign('kategoriinvestigasi_id')->references('id')->on('kategori_investigasis')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('updateinvestigasis');
    }
}
