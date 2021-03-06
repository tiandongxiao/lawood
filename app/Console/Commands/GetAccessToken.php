<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use EasyWeChat\Foundation\Application;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class GetAccessToken extends Command
{
    private $application;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'access_token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Application $application)
    {
        parent::__construct();
        $this->application = $application;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Log::info('Ｉ');
        $accessToken = $this->application->access_token;
        # 获取access_token
        $token = $accessToken->getToken(true);

        $expiresAt = Carbon::now()->addHours(2);
        Cache::put('wx_access_token',$token,$expiresAt);
    }
}
