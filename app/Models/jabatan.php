<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jabatan extends Model
{
    use HasFactory;

    protected $table = 'tb_m_jabatan';

    protected $fillable = ['id_tmja','kode_jbt','formasi_jbt'];
}
