<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotoInvestigasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foto_investigasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('updateinvestigasi_id');
            $table->string('judul');
            $table->string('path');
            $table->timestamps();


            $table->foreign('updateinvestigasi_id')->references('id')->on('updateinvestigasis')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foto_investigasis');
    }
}
