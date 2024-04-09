<?php

use CodersCanine\JsonService\JsonService;
use CodersCanine\ArtistService\ArtistService;
use CodersCanine\AlbumService\AlbumService;
use CodersCanine\SongService\SongService;

$ArtistService = new ArtistService();
$AlbumService = new AlbumService();
$SongService = new SongService();
$JsonService = new JsonService();

$allArtistsArray = $ArtistService->createArtistProfile($AlbumService);

return $JsonService->convertArrayToJson($allArtistsArray);