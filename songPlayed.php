git <?php

require_once 'vendor/autoload.php';

use CodersCanine\DatabaseConnector\DatabaseConnector;
use CodersCanine\JsonService\JsonService;
use CodersCanine\SongPlayedService\SongPlayedService;
use CodersCanine\AppFactory\AppFactory;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$songPlayedService = new SongPlayedService();
$json = file_get_contents('php://input');
$data = json_decode($json, true);

$factory = new AppFactory();
$factory->createSetUp();

$songPlayedService->updatePlayCount($data['name'], $data['artist'], $factory->getDb(), $data);