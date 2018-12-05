<?php

$dbPassword = "1234";
$dbUserName = "root";
$dbServer = "localhost";
$dbName = "taskManager";

$connection = new mysqli($dbServer, $dbUserName, $dbPassword, $dbName);

//print_r($connection);

if ($connection->connect_errno) {
    exit("Database Connection Failed. Reason: " . $connection->connect_error);
}

