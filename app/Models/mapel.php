<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mapel extends Model
{
    use HasFactory;

    protected $table = 'tb_m_mapel';

    protected $fillable = ['id_tmm','kode_mapel','mapel'];
}
