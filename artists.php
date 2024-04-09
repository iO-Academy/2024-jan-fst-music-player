<?php

require_once 'vendor/autoload.php';

use CodersCanine\JsonService\JsonService;
use CodersCanine\ArtistService\ArtistService;
use CodersCanine\AlbumService\AlbumService;
use CodersCanine\SongService\SongService;
use CodersCanine\DatabaseConnector\DatabaseConnector;
use CodersCanine\ArtistHydrator\ArtistHydrator;
use CodersCanine\AlbumHydrator\AlbumHydrator;
use CodersCanine\SongHydrator\SongHydrator;
header("Access-Control-Allow-Origin: *");

try {
    $db = new DatabaseConnector();
    $db = $db->connect();

    SongHydrator::setDb($db);
    AlbumHydrator::setDb($db);
    ArtistHydrator::setDb($db);

    $ArtistService = new ArtistService();
    $AlbumService = new AlbumService();
    $SongService = new SongService();
    $JsonService = new JsonService();

    $allArtistsArray = $ArtistService->createArtistProfile($AlbumService, $SongService);

    echo $JsonService->convertArrayToJson($allArtistsArray);
}
catch (Throwable) {
    http_response_code(500);
    $errorMessage = ["message" => "Unexpected error"];
    echo json_encode($errorMessage);
}
