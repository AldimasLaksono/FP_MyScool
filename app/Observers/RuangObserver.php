<?php

namespace App\Observers;
use App\Models\Log;

class RuangObserver
{
    public function created()
    {
        Log::create([
            'module' => 'Created-RG',
            'action' => 'Tambah Ruangan',
            'useraccess' => 'Administrator'
        ]);
    }

    public function updated()
    {
        Log::create([
            'module' => 'Sunting-RG',
            'action' => 'Sunting Ruangan',
            'useraccess' => 'Administrator'
        ]);
    }

    public function delete()
    {
        Log::create([
            'module' => 'delete-RG',
            'action' => 'delete Ruangan',
            'useraccess' => 'Administrator'
        ]);
    }
}
