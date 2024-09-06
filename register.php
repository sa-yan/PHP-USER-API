<?php

require "connection.php";
require "sendMail.php";

$userName = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];

if(empty($userName) && empty($email)&& empty($password)){
    $response['error'] = true;
    $response['message'] = "All fields are mandatory";
    exit;
}


$checkUser = "SELECT * FROM user WHERE email='$email'";
$checkQuery = mysqli_query($conn, $checkUser);

if (mysqli_num_rows($checkQuery) > 0) {
    $response['error'] = true;
    $response['message'] = "User Already Exists";
} else {

    $insertQuery = "INSERT INTO user(username, email, password)
    VALUES('$userName', '$email', '$password')";

    $result = mysqli_query($conn, $insertQuery);
    if ($result) {
        sendMail($email, $userName);
        $response['error'] = false;
        $response['message'] = "Registration successful";
    } else {
        $response['error'] = true;
        $response['message'] = "Registration Failed!";
    }
}

echo json_encode($response);

mysqli_close($conn);
