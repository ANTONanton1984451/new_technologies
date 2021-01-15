<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function index()
    {
        $

        return response()->json(array_merge($status,$message),500);
    }
}
