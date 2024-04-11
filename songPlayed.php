<?php

require_once 'vendor/autoload.php';

use CodersCanine\DatabaseConnector\DatabaseConnector;
use CodersCanine\JsonService\JsonService;
use CodersCanine\SongPlayedService\SongPlayedService;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Header: *");

$songPlayedService = new SongPlayedService;

try {
    $db = new DatabaseConnector();
    $db = $db->connect();
} catch (Throwable) {
    http_response_code(400);
    $errorMessage = ['message' => 'Unexpected error', 'data' => $_POST];
}

$songPlayedService->updatePlayCount($_POST['name'], $_POST['artist'], $db, $_POST);


