<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Log;

class UserObserver
{
    // public function creating(User $user){
   //    $user->last_login = now();
   // }

   public function created(User $user)
   {
      Log::create([
         'module' => 'register',
         'action' => 'register akun',
         'useraccess' => $user->email
      ]);
   }
}
