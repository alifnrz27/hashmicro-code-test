<?php
namespace App\Helpers;

class ResponseHelper
{
    public static function response(int $code, string $message, $data = null)
    {
        return [
            'code' => $code,
            'success' => $code >= 200 && $code < 300,
            'message' => $message,
            'data' => $data
        ];
    }
}
