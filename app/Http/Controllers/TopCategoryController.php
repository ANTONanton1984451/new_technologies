<?php

namespace App\Http\Controllers;

use App\Models\Top;
use Illuminate\Http\Request;

class TopCategoryController extends Controller
{
    public function getPositions(Request $request)
    {

        $top = new Top();
        $top->date = time();
        $top->ratings = json_encode(['test'=>'test']);
        $top->save();
        return redirect('/');
    }
}
