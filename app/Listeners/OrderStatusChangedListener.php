<?php

namespace App\Listeners;

use Amsgames\LaravelShop\Events\OrderStatusChanged;
use App\Order;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class OrderStatusChangedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderStatusChanged  $event
     * @return void
     */
    public function handle(OrderStatusChanged $event)
    {
        $order = Order::findOrFail($event->id);
        # 不得已而为之，未知原因造成的废单
        if($order->statusCode == 'pending'){
            if(is_null($order->order_no)){
                $order->statusCode = 'abandoned';
                $order->save();
            }
        }
    }
}
