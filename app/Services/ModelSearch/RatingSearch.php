<?php


namespace App\Services\ModelSearch;


use App\Models\Top;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;


class RatingSearch
{
    /**
     * @param int $date
     * @return \Illuminate\Http\JsonResponse
     * @throws ModelNotFoundException
     * Поиск модели по дате и выдача ответа в json формате.
     * Вынос логики в сервис класс
     */
    public function getRatingByDate(int $date) : JsonResponse
    {
        $model = Top::findOrFail($date);

        $response = [
            'status_code' => 200,
            'message' => 'ok',
            'data' => $model->ratings
        ];

        return response()->json($response);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * Вынос логики в сервис класс
     */
    public function getNotFoundResponse() : JsonResponse
    {
        $response = [
            'status_code' => 404,
            'message' => 'rating not found',
        ];

        return response()->json($response,404);
    }
}
