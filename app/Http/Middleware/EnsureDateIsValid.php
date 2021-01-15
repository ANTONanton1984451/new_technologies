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

        $messages = [
            'date.required'=>'Missing date query parameter',
            'date.date_format'=>'Invalid date format'
        ];

       $validator = Validator::make(['date'=>$request->date],$rules,$messages);

       if($validator->fails()){
           return redirect()->action([ErrorController::class,'index']);
       }


        return $next($request);
    }
}
