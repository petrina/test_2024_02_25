<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ServerErrorException extends BaseException
{
    public function render(Request $request): Response
    {
        response()
            ->json([
                'status' => false,
                'error' => $this->getErrorMessage()
            ], 500)
            ->header('Content-Type', 'application/json')
            ->header('Access-Control-Allow-Origin', '*')
            ->send();
        die;
    }
}
