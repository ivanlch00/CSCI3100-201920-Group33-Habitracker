<?php

$servername = "localhost"; //will change if upload on online server
$dBUsername = "root";
$dBPassword = "";
$dBName = "Habitracker";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
    die("Connection failed." .mysqli_connect_error());
}
