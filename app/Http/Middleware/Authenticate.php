<?php

namespace App\Http\Middleware;

use App\Traits\AgentDevTrait;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class Authenticate
{
    use AgentDevTrait;
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                if($this->isWxBrowser()){
                    return redirect()->guest('wx/warning');
                }
                return redirect()->guest('login/email');
            }
        }

        return $next($request);
    }
}
