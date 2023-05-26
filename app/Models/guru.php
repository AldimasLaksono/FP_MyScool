<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class guru extends Model
{
    use HasFactory;

    protected $table = 'tb_m_guru';

    protected $fillable = [
        'id_tmg', 'nip',
        'nama_guru',
        'email_guru',
        'ttl_guru',
        'gender_guru',
        'notelp_guru',
        'alamat_guru',
        'status_guru',
        'foto_guru',
        'id_tmja',
        'id_tmm',
        'id_tmu'
    ];
}
