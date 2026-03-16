<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTglJointToInvestigasis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('investigasis', function (Blueprint $table) {
            // Tambahkan kolom tanggal joint jika belum ada
            if (!Schema::hasColumn('investigasis', 'tgl_joint')) {
                $table->date('tgl_joint')->nullable()->after('tgl_efektif_polis');
            }
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
            if (Schema::hasColumn('investigasis', 'tgl_joint')) {
                $table->dropColumn('tgl_joint');
            }
        });
    }
}
