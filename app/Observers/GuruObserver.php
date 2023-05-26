<?php

namespace App\Observers;
use App\Models\Log;

class GuruObserver
{
    public function created()
    {
        Log::create([
            'module' => 'Created-DGU',
            'action' => 'Tambah Data Guru',
            'useraccess' => 'Administrator'
        ]);
    }
}
