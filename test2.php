<?php

$dbServername = "";
$dbUsername = "";
$dbPassword = "";
$dbName = "";

$mysqli = new mysqli($servername, $user, $password, $database);

if ($mysqli->connect_error) {
    die('Connect Error (' .
    $mysqli->connect_errno . ') '.
    $mysqli->connect_error);
}
// Data presented from high to low score
$sql = " SELECT * FROM userdata ORDER BY score DESC ";
$result = $mysqli->query($sql);
$mysqli->close();