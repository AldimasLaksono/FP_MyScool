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
        Schema::create('tb_t_jawaban', function (Blueprint $table) {
            $table->id('id_tj');
            $table->unsignedBigInteger('id_ts');
            $table->foreign('id_ts')->references('id_ts')->on('tb_t_student');
            $table->string('desk_tj')->nullable();
            $table->string('gmb_tj')->nullable();
            $table->string('file_tj')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_t_jawaban');
    }
};
