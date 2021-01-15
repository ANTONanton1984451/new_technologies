<?php

namespace App\Http\Middleware;

use App\Contracts\IPStorage;
use Closure;
use Illuminate\Http\Request;


class ProtectionIP
{

    private IPStorage $storage;

    public function __construct(IPStorage $storage)
    {
        $this->storage = $storage;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $ip = $request->ip();

        if(!$this->storage->isset($ip)){

           $this->storage->set($ip);
           $direction = $next($request);

        }else{

            if($this->storage->isLimitRequests($ip)){
                $direction = redirect('/')->setStatusCode(403);
            }else{
                $this->storage->incrementRequestsCount($ip);
               $direction = $next($request);
            }

        }

        return $direction;
    }
}
