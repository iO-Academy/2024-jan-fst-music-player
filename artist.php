<?php

require_once 'vendor/autoload.php';

header("Access-Control-Allow-Origin: *");
use CodersCanine\Factory\Factory;

$factory = new Factory();
$factory->createSetUp();

isset($_GET['name']) ?  $artistName = $_GET['name'] : $artistName = '%';

$allArtistsArray = $factory->getArtistService()->createArtistProfile($factory->getAlbumService(), $factory->getSongService(), $artistName);


echo $factory->getJsonService()->convertArrayToJson($allArtistsArray);