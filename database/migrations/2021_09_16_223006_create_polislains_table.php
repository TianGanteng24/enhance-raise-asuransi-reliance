<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolislainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polislains', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('investigasi_id');
            $table->unsignedBigInteger('asuransi_id');
            $table->date('issued_polis');
            $table->integer('up');
            $table->timestamps();

            $table->foreign('investigasi_id')->references('id')->on('investigasis')->onDelete('restrict');
            $table->foreign('asuransi_id')->references('id')->on('asuransis')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('polislains');
    }
}
