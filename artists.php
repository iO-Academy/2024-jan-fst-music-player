<?php

require_once 'vendor/autoload.php';

header("Access-Control-Allow-Origin: *");
use CodersCanine\AppFactory\AppFactory;

$factory = new AppFactory();
$factory->createSetUp();

isset($_GET['name']) ?  $artistName = $_GET['name'] : $artistName = '%';

$allArtistsArray = $factory->getArtistService()->createArtistProfile($factory->getAlbumService(), $factory->getSongService(), $artistName);

if (count($allArtistsArray) === 0) {
    http_response_code(400);
    $errorMessage = ["message" => "Unknown artist name"];
} else {
    echo $factory->getJsonService()->convertArrayToJson($allArtistsArray);
}

