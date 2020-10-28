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
    if (isset($_POST['emailList'])) {
        $emailList = $_POST['emailList'];
        $content = file_get_contents("../ticketData/newStudents.json");
        $content = json_decode($content, true);

        $emails = explode(',', $emailList);
        foreach ($emails as $studentEmail) {
            $studentID = uniqid('STU');
            $content["$studentID"] = array("Email" => $studentEmail, "Status" => "Password E-mail not sent");
        }
        $content["emails"] = $emails;
        file_put_contents("../ticketData/newStudents.json", json_encode($content));
        echo (json_encode ( array( "message" => "Emails saved." ) ) );
    } else {
        echo (json_encode ( array( "message" => "No email list specified." ) ) );
    }
?>
 