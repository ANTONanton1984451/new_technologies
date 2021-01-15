<?php


namespace App\Http\Middleware;


use Illuminate\Foundation\Http\Middleware\TransformsRequest;

class StrToTime extends TransformsRequest
{

    /**
     * @var array
     */
    private $notExcept = [
        'date'
    ];

    /**
     * @param string $key
     * @param mixed $value
     * @return false|int|mixed
     * Преобразует значения из массива $notExcept  в timestamp
     */
    protected function transform($key, $value)
    {
        if(in_array($key,$this->notExcept)){

            return strtotime($value);
        }
        return $value;
    }
}
