<?php

namespace App\Observers;
use App\Models\Log;

class MapelObserver
{
    public function created()
    {
        Log::create([
            'module' => 'Created-MP',
            'action' => 'Tambah Mapel',
            'useraccess' => 'Administrator'
        ]);
    }

    public function updated()
    {
        Log::create([
            'module' => 'Sunting-MP',
            'action' => 'Sunting Mapel',
            'useraccess' => 'Administrator'
        ]);
    }

    public function delete()
    {
        Log::create([
            'module' => 'delete-MP',
            'action' => 'delete Mapel',
            'useraccess' => 'Administrator'
        ]);
    }
}
