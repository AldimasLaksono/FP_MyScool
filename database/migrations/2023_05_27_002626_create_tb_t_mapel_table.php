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
        Schema::create('tb_t_mapel', function (Blueprint $table) {
            $table->id('id_tm');
            $table->unsignedBigInteger('id_mj');
            $table->foreign('id_mj')->references('id_mj')->on('tb_m_jurusan');
            $table->unsignedBigInteger('id_mm');
            $table->foreign('id_mm')->references('id_mm')->on('tb_m_mapel');
            $table->unsignedBigInteger('id_mut');
            $table->foreign('id_mut')->references('id_mut')->on('tb_m_user_teacher');
            $table->string('kode_mm_tm');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_t_mapel');
    }
};
