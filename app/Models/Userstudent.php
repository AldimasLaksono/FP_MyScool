<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Userstudent extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    //definiskan tabel secara manual
    protected $table = 'tb_m_user_student';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nis',
        'name_mus',
        'ttl_mus',
        'gender_mus',
        'alamat_mus',
        'notelp_mus',
        'email_mus',
        'foto_mus',
        'password',
        'status_mus',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function setPasswordAttribute($password){
        $this->attributes['password']=bcrypt($password);
    }
}
