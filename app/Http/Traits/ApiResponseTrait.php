<?php

namespace App\Http\Traits;

trait ApiResponseTrait
{
    private function apiResponse(int $code = 200, string $message = null, object|array $data = null, object|array $errors = null): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $array = [
            'status' => $code,
            'message' => $message,
        ];

        if ($data != null) {
            $array['data'] = $data;
        } elseif ($errors != null) {
            $array['errors'] = $errors;
        }
        return response($array, 200);
    }
}
