<?php

namespace App\Exceptions;


use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class ApiException extends HttpResponseException
    {
        public function __construct($code=422, $message="Validation error", $errors= [])
        {
            $data = [
                "error"=>[
                    "code" => $code,
                    "message" => $message,
                ]
            ];

            if ($errors) {
                $data["error"]["errors"] = $errors;
            }
            parent::__construct(response()->json($data, $code));
        }
}
