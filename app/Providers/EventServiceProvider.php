<?php

namespace App\Providers;

use App\Events\TourCreated;
use App\Events\TourUpdated;
use App\Listeners\CreateTourDates;
use App\Listeners\UpdateTourDates;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        TourCreated::class => [
            CreateTourDates::class,
        ],
        TourUpdated::class => [
            UpdateTourDates::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
