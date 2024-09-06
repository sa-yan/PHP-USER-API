<?php

header('Content-Type: application/json');

require "connection.php";

$getAllUsers = "SELECT * FROM user";
$result = mysqli_query($conn, $getAllUsers);


$response = array();

if(mysqli_num_rows($result)>0) {
    $output = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($output);
} else {
    echo json_encode(array("error"=>false, "message"=>"No record found.",));
}


$conn->close();
