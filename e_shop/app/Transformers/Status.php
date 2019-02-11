<?php

namespace App\Transformers;

class Status
{
    public static function response($data = null, $status = null, $message = "Nothing found", $code = 404)
    {
        return [
            'data'          =>$data,
            'status'        => $status,
            'message'       => $message,
            'code'          => $code,
        ];
    }
}