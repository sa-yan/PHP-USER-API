<?php

require "connection.php";
require "sendMail.php";

$response = array();

if (isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])) {

    $userName = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    if (empty($userName) && empty($email) && empty($password)) {
        $response["error"] = true;
        $response["message"] = "All fields are required !";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response["error"] = true;
        $response["message"] = "Please provide a valid email adress";
    } else if (strlen($password) < 5) {
        $response["error"] = true;
        $response["message"] = "The password must consist of a minimum of 6 digits.";
    } else {
        $checkUser = "SELECT * FROM user WHERE email='$email'";
        $checkQuery = mysqli_query($conn, $checkUser);

        if (mysqli_num_rows($checkQuery) > 0) {
            $response['error'] = true;
            $response['message'] = "User Already Exists";
        } else {

            $insertQuery = "INSERT INTO user(username, email, password)
        VALUES('$userName', '$email', '$hashedPassword')";

            $result = mysqli_query($conn, $insertQuery);

            if ($result) {

                $userId = mysqli_insert_id($conn);

                sendMail($email, $userName);
                $response['error'] = false;
                $response['message'] = "Registration successful";
                $response['username'] = $userName;
                $response['email'] = $email;
                $response['id'] = $userId;
            } else {
                $response['error'] = true;
                $response['message'] = "Registration Failed!";
            }
        }
    }
} else {
    $response['error'] = true;
    $response['message'] = "Registration Failed!" + mysqli_error($conn);
}


echo json_encode($response);

mysqli_close($conn);
