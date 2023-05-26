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
        Schema::create('tb_t_student', function (Blueprint $table) {
            $table->id('id_ts');
            $table->unsignedBigInteger('id_tc');
            $table->foreign('id_tc')->references('id_tc')->on('tb_t_class');
            $table->unsignedBigInteger('id_mus');
            $table->foreign('id_mus')->references('id_mus')->on('tb_m_user_student');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_t_student');
    }
};
