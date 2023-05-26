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
        Schema::create('tb_t_period_class', function (Blueprint $table) {
            $table->id('id_tpc');
            $table->unsignedBigInteger('id_mper');
            $table->foreign('id_mper')->references('id_mper')->on('tb_m_period');
            $table->string('name_tpc');
            $table->string('description_tpc');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_t_period_class');
    }
};
