<?php

namespace API\Platform\Utils;

class ResponseHandler
{
    public static function success($message, $data = [], $code = 200)
    {
        http_response_code($code);
        header('Content-Type: application/json');
        echo json_encode([
            'code' => $code,
            'message' => $message,
            'data' => $data
        ]);
    }

    public static function error($code, $message, $details = [])
    {
        http_response_code($code);
        header('Content-Type: application/json');
        echo json_encode([
            'code' => $code,
            'message' => $message,
            'details' => $details
        ]);
    }
}