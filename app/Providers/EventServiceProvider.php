<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use App\Models\User; //panggil model user
use App\Models\jabatan; //panggil model jabatan
use App\Models\gedung;
use App\Models\mapel;
use App\Models\ruang;
use App\Models\guru;
use App\Observers\JbtObserver;
use App\Observers\UserObserver; //panggil observer UserObserver
use App\Observers\GedungObserver;
use App\Observers\MapelObserver;
use App\Observers\RuangObserver;
use App\Observers\GuruObserver;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
        jabatan::observe(JbtObserver::class);
        gedung::observe(GedungObserver::class);
        mapel::observe(MapelObserver::class);
        ruang::observe(RuangObserver::class);
        guru::observe(GuruObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
