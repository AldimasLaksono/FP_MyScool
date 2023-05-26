<?php

namespace App\Observers;
use App\Models\Log;

class GedungObserver
{
    public function created()
    {
        Log::create([
            'module' => 'Created-GD',
            'action' => 'Tambah Gedung',
            'useraccess' => 'Administrator'
        ]);
    }

    public function updating()
    {
        Log::create([
            'module' => 'Sunting-GD',
            'action' => 'Sunting Gedung',
            'useraccess' => 'Administrator'
        ]);
    }

    public function delete()
    {
        Log::create([
            'module' => 'delete-GD',
            'action' => 'Delete Gedung',
            'useraccess' => 'Administrator'
        ]);
    }
}
