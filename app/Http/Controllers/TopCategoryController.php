<?php

namespace App\Http\Controllers;

use App\Models\Top;
use App\Services\ModelSearch\RatingSearch;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class TopCategoryController extends Controller
{
    public function getPositions(Request $request,RatingSearch $search)
    {

        try{
         $response = $search->getRatingByDate($request->date);
        }catch (ModelNotFoundException $e){
         $response = $search->getNotFoundResponse();
        }

        return $response;
    }
}
