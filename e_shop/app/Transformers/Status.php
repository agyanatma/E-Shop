<?php

namespace App\Transformers;

class Status
{
    public static function response($data = null, $status = null, $comment = "Nothing found", $code = 404)
    {
        return [
            'data'          =>$data,
            'status'        => $status,
            'comment'       => $comment,
            'code'          => $code,
        ];
    }
}