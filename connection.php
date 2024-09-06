<?php

$hostName = "localhost";
$dbName = "user_db";
$userName = "newuser";
$password = "password";

$conn = mysqli_connect($hostName, $userName, $password, $dbName);

if (!$conn) {
    echo "Connection Failed!";
}
