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
  if (isset($_POST['pw'])) {
    $pw = $_POST['pw'];
    changePassword($user_name, $pw);
     echo (json_encode ( array( "message" => "password change ok" ) ) );
  }
  echo (json_encode ( array( "message" => "no password specified" ) ) );

?>
 