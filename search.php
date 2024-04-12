<?php

require_once 'vendor/autoload.php';

use CodersCanine\AppFactory\AppFactory;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$factory = new AppFactory();
$factory->createSetUp();
$songService = $factory->getSongService();
$jsonService = $factory->getJsonService();

try {
    if (isset($_GET['name'])) {
        $searchData= $_GET['name'];
        $searchedSongArray = $songService->createSearchProfile($searchData);
        echo $jsonService->convertArrayToJson($searchedSongArray);
    } else {
        http_response_code(400);
        throw new Exception('{"message": "Invalid search data", "data": []}');
    }
} catch (Throwable $e) {
    http_response_code(400);
    $errorMessage = ["message" => "Invalid search data", "data" => []];
    echo json_encode($errorMessage);
    echo $e->getMessage();
}

