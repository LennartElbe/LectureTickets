<?php
    if (!isset($_SESSION)) { 
    session_start(); /// initialize session
    }
    include("../code/php/AC.php");
    $user_name = check_logged(); /// function checks if visitor is logged.

    if (!$user_name) {
        echo (json_encode ( array( "message" => "no user name" ) ) );
        return; // nothing
    }

    $subject = "Green Iguana: Create your Password";
    $message = "Hey Student!\n Hier ist ein Link mit dem Sie ihr Passwort setzen Könnt. Wenn sie ihr Passwort danach
                noch ändern wollt, können sie das auf der Website selbst tun. Falls sie es vergessen müssen sie X tun.\n
                http://localhost:8000/php/createViaEmail.php/";
    $content = file_get_contents("../ticketData/newStudents.json");
    $content = json_decode($content, true);
    foreach ($content as $student) {
        if ($student["sentStatus"] == false) {
            $message .= $student; // is $student the object of values or is it the id of the object in $content?
            mail($student["Email"], $subject, $message);
            echo (json_encode ( array( "message" => "Email sent." ) ) );
        }
    }
    echo (json_encode ( array( "message" => "All Emails have been sent." ) ) );

    $studentID = content;
    file_put_contents("../ticketData/newStudents.json", json_encode($content));
?>
 