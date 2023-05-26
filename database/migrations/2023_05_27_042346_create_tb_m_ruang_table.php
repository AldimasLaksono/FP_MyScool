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
        Schema::create('tb_m_ruang', function (Blueprint $table) {
            $table->id('id_mr');
            $table->unsignedBigInteger('id_mg');
            $table->foreign('id_mg')->references('id_mg')->on('tb_m_gedung');
            $table->string('name_mr');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_m_ruang');
    }
};
