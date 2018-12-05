<?php

require './includes.php';

header("Access-Control-Allow-Origin: *");
header('Content-type: application/json');


$routes_loader = new routes_loader();

$link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$path = parse_url($link, PHP_URL_PATH);
$exploded_path = explode('/', $path);
$controller_name=$exploded_path[count($exploded_path) - 2];
$method_name=$exploded_path[count($exploded_path) - 1];

echo $routes_loader->invoke($controller_name,$method_name,$_GET);

die();

