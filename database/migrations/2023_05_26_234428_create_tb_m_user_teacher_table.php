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
        Schema::create('tb_m_user_teacher', function (Blueprint $table) {
            $table->id('id_mut');
            $table->unsignedBigInteger('id_mja');
            $table->foreign('id_mja')->references('id_mja')->on('tb_m_jabatan');
            $table->bigInteger('nip');
            $table->string('name_mut',50);
            $table->string('ttl_mut',150);
            $table->enum('gender_mut',['L','P']);
            $table->text('alamat_mut');
            $table->bigInteger('notelp_mut');
            $table->string('email_mut');
            $table->enum('status_mut',['tetap','honorer']);
            $table->string('foto_mut')->nullable();
            $table->enum('role_mut',['admin','guru']);
            $table->text('password');
            $table->enum('status',['active','deactive']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_m_user_teacher');
    }
};
