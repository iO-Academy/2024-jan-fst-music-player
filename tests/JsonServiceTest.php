<?php

use PHPUnit\Framework\TestCase;
use CodersCanine\JsonService\JsonService;

class JsonServiceTest extends TestCase
{
    public function testJsonService_success()
    {
        $testObject = new JsonService();
        $expected = '{"name":"Michael Jackson"}';
        $input = ['name' => 'Michael Jackson'];
        $result = $testObject->convertArrayToJson($input);
        $this->assertEquals($expected, $result);
    }
    public function testJsonService_malformed()
    {
        $testObject = new JsonService();
        $expected = '[]';
        $input = [];
        $result = $testObject->convertArrayToJson($input);
        $this->assertEquals($expected, $result);
    }

}