<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_t_presensi', function (Blueprint $table) {
            $table->id('id_tp');
            $table->unsignedBigInteger('id_mus');
            $table->foreign('id_mus')->references('id_mus')->on('tb_m_user_student');
            $table->enum('status',['masuk','pulang']);
            $table->text('lokasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_t_presensi');
    }
};
