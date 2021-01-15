<?php


namespace App\Services\Endpoint;


use Carbon\Carbon;

class Endpoint
{
    private const INTERVAL = 30;

    private EndpointConverter $converter;
    private EndpointGetter $getter;

    private string $dateFormat;

    public function __construct(EndpointConverter $converter, EndpointGetter $getter)
    {
        $this->dateFormat = config('endpoint.dateformat');

        $this->converter = $converter;
        $this->getter = $getter;
    }

    public function getRatingByDay() : array
    {
        $dayInterval = $this->formDayInterval();
        $unHandledRating = $this->getter->getRatings($dayInterval['dayAgo'],$dayInterval['now']);

        return $this->converter->convertRating($unHandledRating)[0];
    }

    public function getRatingByMonth() : array
    {
        $monthInterval = $this->formMonthInterval();
        $unHandledRating = $this->getter->getRatings($monthInterval['monthAgo'],$monthInterval['now']);

        return $this->converter->convertRating($unHandledRating);
    }

    private function formMonthInterval() : array
    {
        $monthInterval['now'] = Carbon::now()->format($this->dateFormat);
        $monthInterval['monthAgo'] = Carbon::now()->subDays(self::INTERVAL)->format($this->dateFormat);

        return  $monthInterval;
    }

    private function formDayInterval() : array
    {
        $dayInterval['now'] = Carbon::now()->format($this->dateFormat);
        $dayInterval['dayAgo'] = '';

        return $dayInterval;
    }

}
