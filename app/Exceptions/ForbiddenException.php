<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ForbiddenException extends Exception
{
    public function render(Request $request): Response
    {
        response()
            ->json([
                'status' => false,
                'error' => 'Forbidden Exception'
            ], 403)
            ->header('Content-Type', 'application/json')
            ->header('Access-Control-Allow-Origin', '*')
            ->send();
        die;
    }
}
