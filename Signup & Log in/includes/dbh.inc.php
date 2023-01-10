<?php

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "MathemaContest";

$conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);

// Check connection
if (!$conn) {
    die("Connection Failed " . mysqli_connect_error());
}
