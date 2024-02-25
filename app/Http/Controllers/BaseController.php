<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function jsonResponse(mixed $data, int $status = 200)
    {
        response()
            ->json([
                'status' => true,
                'data' => $data
            ], $status)
            ->header('Content-Type', 'application/json')
            ->header('Access-Control-Allow-Origin', '*')
            ->send();
    }
}
