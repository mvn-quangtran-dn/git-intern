<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\User;
use App\Profile;
use App\Observers\UserObserver;
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
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        // User::observe(UserObserver::class);
        // Post::observe(PostObserver::class);
        // Product::observe(ProductObserver::class);

        // User::updated(function ($user){});
        // User::updating(function ($user){});
        // User::deleting(function ($user){});
        // Post::created(function ($post){

        // });
    }
}
