<?php

require "connection.php";

if (isset($_POST["email"]) && isset($_POST["password"])) {

    $email = $_POST["email"];
    $password = $_POST["password"];
    
    // Check if the user exists with the given email
    $checkUser = "SELECT * FROM user WHERE email='$email'";
    $result = mysqli_query($conn, $checkUser);

    if(mysqli_num_rows($result) > 0){
        $user = mysqli_fetch_assoc($result);
        $storedHashedPassword = $user["password"];

        // Verify the entered password with the hashed password from the database
        if(password_verify($password, $storedHashedPassword)){
            $response['error'] = false;
            $response['message'] = "Login Successful";
            $response['username'] = $user['username'];
            $response['email'] = $user['email'];
            $response['id'] = $user['id'];
        } else {
            $response['error'] = true;
            $response['message'] = "Incorrect password";
        }
    } else {
        $response['error'] = true;
        $response['message'] = "No account is associated with this email";
    }
    
} else {
    $response['error'] = true;
    $response['message'] = "All fields are required!";
}

echo json_encode($response);

mysqli_close($conn);
