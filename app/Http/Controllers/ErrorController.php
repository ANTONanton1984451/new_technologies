<?php

namespace App\Http\Controllers;


class ErrorController extends Controller
{
    public function index()
    {
        $message = [
          'status_code' => 500,
          'message' => 'invalid date format'
        ];

        return response()->json($message,500);
    }

    public function requestsCount()
    {
        $message = [
            'status_code' => 500,
            'message' => 'too few requests per minute'
        ];

        return response()->json($message,403);
    }
}
