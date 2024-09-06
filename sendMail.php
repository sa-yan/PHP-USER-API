<?php
    function sendMail($to, $username){
    $subject = 'Registration Confirmation';
    $message = "Hello $username,\n\nThank you for registering on our platform.\n\nBest regards,\nYour Company";
    $headers = 'From: sayan.mondal4557@gmail.com' . "\r\n" .
                 'Reply-To: sayan.mondal4557@gmail.com' . "\r\n" .
                 'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);
    }