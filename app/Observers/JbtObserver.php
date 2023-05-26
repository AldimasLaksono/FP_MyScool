<?php

namespace App\Observers;

use App\Models\Log;

class JbtObserver
{
    public function created()
    {
        Log::create([
            'module' => 'Created-Jbt',
            'action' => 'Tambah Jabatan',
            'useraccess' => 'Administrator'
        ]);
    }

    public function updated()
    {
        Log::create([
            'module' => 'Sunting-Jbt',
            'action' => 'Sunting Jabatan',
            'useraccess' => 'Administrator'
        ]);
    }

    public function delete()
    {
        Log::create([
            'module' => 'delete-Jbt',
            'action' => 'delete Jabatan',
            'useraccess' => 'Administrator'
        ]);
    }
}
