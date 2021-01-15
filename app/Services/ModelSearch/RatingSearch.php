<?php


namespace App\Services\ModelSearch;


use App\Models\Top;
use Illuminate\Http\Request;

class RatingSearch
{
    public function getRatingByDate(int $date)
    {
        $model = Top::findOrFail($date);

        $response = [
            'status_code' => 200,
            'message' => 'ok',
            'data' => $model->ratings
        ];

        return response()->json($response);
    }

    public function getNotFoundResponse()
    {
        $response = [
            'status_code' => 404,
            'message' => 'rating not found',
        ];

        return response()->json($response,404);
    }
}
