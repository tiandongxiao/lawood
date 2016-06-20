<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Order;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class AllowOrderBeWithdrew extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    private $order;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if($this->order->statusCode == 'completed'){
            $this->order->update([
                'allow_draw' => true
            ]);
        }
    }
}
