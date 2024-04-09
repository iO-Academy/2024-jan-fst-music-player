<?php

namespace CodersCanine\JsonService;

use Throwable;

class JsonService
{
    public function convertArrayToJson($arrayToConvert): string
    {
        return json_encode($arrayToConvert);
    }
}