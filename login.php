<?php

require "connection.php";

$email = $_POST["email"];
$password = $_POST["password"];

$checkUser = "SELECT * FROM user WHERE email='$email' AND password='$password'";

$result = mysqli_query($conn, $checkUser);

if (mysqli_num_rows($result) > 0) {
    $reponse['error']=false;
    $reponse['message']="Login Successful";
}else{
    $reponse['error']=true;
    $reponse['message']="No account is associated with this email";
}

echo json_encode($reponse);