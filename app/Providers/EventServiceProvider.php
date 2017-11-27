<?php

namespace SigeTurbo\Providers;

use Illuminate\Database\Events\StatementPrepared;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Illuminate\Database\Events\QueryExecuted' => [
            'SigeTurbo\Listeners\QueryExecutedListener',
        ],
        'Illuminate\Auth\Events\Attempting' => [
            'SigeTurbo\Listeners\LogAuthenticationAttemptListener',
        ],
        'Illuminate\Auth\Events\Logout' => [
            'SigeTurbo\Listeners\LogSuccessfulLogoutListener',
        ],
        'Illuminate\Auth\Events\Login' => [
            'SigeTurbo\Listeners\LogSuccessfulLoginListener',
        ],
        'Illuminate\Foundation\Auth\ResetsPasswords' => [
            'SigeTurbo\Listeners\PasswordResetSuccessfulListener',
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

        Event::listen(StatementPrepared::class, function ($event) {
            $event->statement->setFetchMode(\PDO::FETCH_ASSOC);
        });
    }
}
