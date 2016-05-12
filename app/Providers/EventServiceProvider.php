<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Category;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
        ],
        'Amsgames\LaravelShop\Events\OrderCompleted' => [
            'App\Listeners\OrderCompletedListener',
        ],
        'Amsgames\LaravelShop\Events\OrderStatusChanged' => [
            'App\Listeners\OrderStatusChangedListener',
        ],
        'Amsgames\LaravelShop\Events\OrderPlaced' => [
            'App\Listeners\OrderPlacedListener',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);
        Category::observe(\VergilLai\NodeCategories\Observer::class);
        //
    }
}
