<?php


namespace App\Services\Endpoint;


class EndpointConverter
{
    private const IMPOSSIBLE_POSITION = 9999999999;

    /**
     * @param array $unhandledRating
     * @return array
     * Преобразует массив,полученный в методе ниже к виду:
     * [
     *   ['date'=>timestamp,'ratings'=> json],
     *   ['date'=>timestamp,'ratings'=> json],
     *    .................
     * ]
     * Данный массив повторяет структуру таблицы в БД и поэтому кладётся простым методом insert() из модели
     */
    public function convertRating(array $unhandledRating) : array
    {
        $ratingForEntity = [];
        $compiledUpRating = $this->compileRating($unhandledRating);

        $iterator = 0;

        foreach ($compiledUpRating as $date => $ratingList){
            $ratingForEntity[$iterator]['date'] = strtotime($date);
            $ratingForEntity[$iterator]['ratings'] = json_encode($ratingList);
            $iterator++;
        }

        return $ratingForEntity;
    }

    /**
     * @param array $unhandledRating
     * @return array
     * Метод из рейтинга поученного по через API  выдаёт массив вида :
     * ['date' => ['category1' => 'position1',
     *              'category2' => 'position2']
     *
     * Сделал привязку по дате прямо из массива API чтобы была лучшая "синхронизация".
     * Так-то можно было бы составить массив дат через Carbon но могли бы и возникнуть проблемы.
     *
     */
    private function compileRating(array $unhandledRating) : array
    {
        $ratingData = $unhandledRating['data'];

        $categories = array_keys($ratingData);
        $subCategories = array_keys($ratingData[$categories[0]]);
        $dates = array_keys($ratingData[$categories[0]][$subCategories[0]]);

        $rating = [];
        foreach ($dates as $date){

            foreach ($categories as $category){

                $rating[$date][$category] = self::IMPOSSIBLE_POSITION;
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
