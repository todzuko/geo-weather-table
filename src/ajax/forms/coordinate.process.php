<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/load.php';

$enteredLoc = new \Entities\Coordinate();
$enteredLoc->longitude = $_POST['longitude'];
$enteredLoc->latitude = $_POST['latitude'];
$cityList = (new \Handlers\CityListHandler($_ENV['DATA_PATH']))->processFile();

foreach ($cityList as $city) {
    $city->curDistance = $city->coordinate->getDistanceTo($enteredLoc);
}
echo json_encode($cityList);
die();