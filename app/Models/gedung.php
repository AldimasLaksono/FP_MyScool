<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gedung extends Model
{
    use HasFactory;

    protected $table = 'tb_m_gedung';

    protected $fillable = ['id_tmge','gedung'];
}
