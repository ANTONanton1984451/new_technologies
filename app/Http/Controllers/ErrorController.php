<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function index(array $errors)
    {
        $status = ['message' => 'error'];

        $message = ['date'=>'Invalid date format'];

        return response()->json(array_merge($status,$message),500);
    }
}
