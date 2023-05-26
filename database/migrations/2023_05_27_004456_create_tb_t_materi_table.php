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
        Schema::create('tb_t_materi', function (Blueprint $table) {
            $table->id('id_tmat');
            $table->unsignedBigInteger('id_tm');
            $table->foreign('id_tm')->references('id_tm')->on('tb_t_mapel');
            $table->string('judul_tmat');
            $table->string('desk_tmat')->nullable();
            $table->string('gmb_tmat')->nullable();
            $table->string('file_tmat')->nullable();
            $table->tinyInteger('status_tmat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_t_materi');
    }
};
