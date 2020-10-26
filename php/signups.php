<?php // records signup information for specific lecture days
  session_start(); /// initialize session
  
  include("../code/php/AC.php");
  $user_name = check_logged(); /// function checks if visitor is logged.
  
  if (!$user_name) {
     echo (json_encode ( array( "message" => "no user name" ) ) );
     return; // nothing
  }
  if (isset($_GET['action']))
    $action = $_GET['action'];
  else
    $action = null;

  $id = "";
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
  } else {
      echo(json_encode(array("message" => "failed: no class id found")));
      return;
  }

  if ($action == "signup") {
    $content = file_get_contents("../ticketData/signups.json");
    $content = json_decode($content, true);
    if (!in_array($user_name, $content[$id]["signups"])) {
        $content[$id]["signups"][] = $user_name;
    } else {
            echo(json_encode(array("message" => "warning: you are already signed up for this class")));
        return;
    }
    file_put_contents("../ticketData/signups.json", json_encode($content));
    echo(json_encode(array("message" => "done")));
    return;
  } else {
    echo(json_encode(array("message" => "failed: unknown action")));
  }
 ?>
 