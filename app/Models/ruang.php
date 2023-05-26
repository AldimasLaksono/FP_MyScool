<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ruang extends Model
{
    use HasFactory;

    protected $table = 'tb_m_ruang';

    protected $fillable = ['id_tmr','nama_ruang','kategori','id_tmge'];
}
