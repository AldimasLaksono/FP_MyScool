<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Userteacher extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    //definiskan tabel secara manual
    protected $table = 'tb_m_user_teacher';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_mja',
        'nip',
        'name_mut',
        'ttl_mut',
        'gender_mut',
        'alamat_mut',
        'notelp_mut',
        'email_mut',
        'status_mut',
        'foto_mut',
        'role_mut',
        'password',
        'status',
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
