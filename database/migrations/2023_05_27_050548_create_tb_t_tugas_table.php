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
        Schema::create('tb_t_tugas', function (Blueprint $table) {
            $table->id('id_tt');
            $table->unsignedBigInteger('id_tc');
            $table->foreign('id_tc')->references('id_tc')->on('tb_t_class');
            $table->unsignedBigInteger('id_mut');
            $table->foreign('id_mut')->references('id_mut')->on('tb_m_user_teacher');
            $table->string('desk_tj')->nullable();
            $table->string('gmb_tj')->nullable();
            $table->string('file_tj')->nullable();
            $table->dateTime('deadline_tt');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_t_tugas');
    }
};
