<?php


namespace App\Services\Endpoint;


class EndpointConverter
{
    public function convertRating(array $unhandledRating) : array
    {
        $ratingForEntity = [];
        $compiledUpRating = $this->makeUpRating($unhandledRating);

        $iterator = 0;
        foreach ($compiledUpRating as $date => $ratingList){
            $ratingForEntity[$iterator]['date'] = strtotime($date);
            $ratingForEntity[$iterator]['ratings'] = json_encode($ratingList);
            $iterator++;
        }
        return $ratingForEntity;
    }

    private function makeUpRating(array $unhandledRating) : array
    {
        $ratingData = $unhandledRating['data'];

        $categories = array_keys($ratingData);
        $subCategories = array_keys($ratingData[$categories[0]]);
        $dates = array_keys($ratingData[$categories[0]][$subCategories[0]]);

        $rating = [];
        foreach ($dates as $date){

            foreach ($categories as $category){

                $rating[$date][$category] = 999999999;
                $subCategories = $ratingData[$category];

                foreach ($subCategories as $subCategory){

                    if(($subCategory[$date] < $rating[$date][$category]) && $subCategory[$date] !== null ){
                        $rating[$date][$category] = $subCategory[$date];

                    }
                }
            }
        }

        return $rating;
    }
}
