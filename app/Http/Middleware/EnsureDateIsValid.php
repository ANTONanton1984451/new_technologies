<?php

namespace App\Http\Middleware;

use App\Http\Controllers\ErrorController;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EnsureDateIsValid
{
    private $dateformat;

    public function __construct()
    {
        $this->dateFormat = config('endpoint.dateformat');
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
        $rules = [
            'date'=> 'required|date_format:'.$this->dateFormat
        ];

       $validator = Validator::make(['date'=>$request->date],$rules);

       if($validator->fails()){
           return redirect()->action([ErrorController::class,'index']);
       }


        return $next($request);
    }
}
