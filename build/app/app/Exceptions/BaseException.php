<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class BaseException extends Exception
{
    public $request;
    public $message;

    public function report()
    {
        Log::info(
            self::class,
            [
                'client_ip' => $this->request->getClientIp(),
                'request_params' => $this->request->all(),
            ]
        );
    }

    public function render()
    {
        return response()->json(
            self::class,
            500
        );
    }
}
