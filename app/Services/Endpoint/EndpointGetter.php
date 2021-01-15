<?php


namespace App\Services\Endpoint;


use Illuminate\Support\Facades\Http;

class EndpointGetter
{
    private const DATE_FROM = '{{dateFRom}}';
    private const DATE_TO = '{{dateTo}}';

    private const URL = 'https://api.apptica.com/package/top_history/1421444/1?date_from='.self::DATE_FROM.'&date_to='.self::DATE_TO.'&B4NKGg=fVN5Q9KVOlOHDx9mOsKPAQsFBlEhBOwguLkNEDTZvKzJzT3l';

    public function getRatings(string $start,string $end) : array
    {
       $urlWithDates = str_replace([self::DATE_FROM,self::DATE_TO],[$start,$end],self::URL);

       $response = Http::get($urlWithDates);

       return $response->json();
    }
}
