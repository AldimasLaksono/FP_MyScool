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
        Schema::create('tb_m_user_student', function (Blueprint $table) {
            $table->id('id_mus');
            $table->bigInteger('nis');
            $table->string('name_mus',50);
            $table->string('ttl_mus',150);
            $table->enum('gender_mus',['L','P']);
            $table->text('alamat_mus');
            $table->bigInteger('notelp_mus');
            $table->string('email_mus');
            $table->string('foto_mus');
            $table->text('password_mus');
            $table->enum('status_mus',['active','deactive']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_m_user_student');
    }
};
