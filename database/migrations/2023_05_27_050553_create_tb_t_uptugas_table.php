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
        Schema::create('tb_t_uptugas', function (Blueprint $table) {
            $table->id('id_tup');
            $table->unsignedBigInteger('id_tj');
            $table->foreign('id_tj')->references('id_tj')->on('tb_t_jawaban');
            $table->unsignedBigInteger('id_tt');
            $table->foreign('id_tt')->references('id_tt')->on('tb_t_tugas');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_t_uptugas');
    }
};
