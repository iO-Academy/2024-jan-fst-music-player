<?php

namespace CodersCanine\JsonService;

class JsonService
{
    public function convertArrayToJson($arrayToConvert): string
    {
        try {
            $encodedJson = json_encode($arrayToConvert);
            http_response_code(200);
            return $encodedJson;
        } catch (\Throwable $e) {
            http_response_code(500);
            $errorMessage = $e . ' Unexpected error';
            return json_encode($errorMessage);
        }
    }
}