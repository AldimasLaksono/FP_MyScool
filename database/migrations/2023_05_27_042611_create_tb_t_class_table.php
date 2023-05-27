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
        Schema::create('tb_t_class', function (Blueprint $table) {
            $table->id('id_tc');
            $table->unsignedBigInteger('id_tpc');
            $table->foreign('id_tpc')->references('id_tpc')->on('tb_t_period_class');
            $table->unsignedBigInteger('id_mr');
            $table->foreign('id_mr')->references('id_mr')->on('tb_m_ruang');
            $table->unsignedBigInteger('id_mj');
            $table->foreign('id_mj')->references('id_mj')->on('tb_m_jurusan');
            $table->string('name_tc');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_t_class');
    }
};
