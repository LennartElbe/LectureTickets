<?php
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
  $className = "";      
  if (isset($_GET['className']))
    $className = $_GET['className'];
  
  $classNumber = "";
  if (isset($_GET['classNumber']))
    $classNumber = $_GET['classNumber'];

  $classDate = "";
  if (isset($_GET['classDate']))
    $classDate = $_GET['classDate'];
  
  $classStartTime = "";
  if (isset($_GET['classStartTime']))
    $classStartTime = $_GET['classStartTime'];

  $classEndTime = "";
  if (isset($_GET['classEndTime']))
    $classEndTime = $_GET['classEndTime'];

  $classSeatCount = "";
  if (isset($_GET['classSeatCount']))
    $classSeatCount = $_GET['classSeatCount'];

  if ($action == "create") {
    if (!check_role( "admin" )) {
       return;
    }
    $content = file_get_contents("../ticketData/classes.json");
    $content = json_decode($content, true);
    $content[] = array( "className" => $className,
                        "classNumber" => $classNumber,
                        "classDate" => $classDate,
                        "classStartTime" => $classStartTime,
                        "classEndTime" => $classEndTime,
                        "classSeatCount" => $classSeatCount,
                        "id" => uniqid("LTS"));

    file_put_contents("../ticketData/classes.json", json_encode($content));
    echo(json_encode(array("message" => "done")));
    return;
  } elseif ($action == "delete") {
      if (!check_role("admin")) {
        return;
      }
      $id = "";
      if (isset($_GET['id']))
        $id = $_GET['id'];
      if ($id == "") {
        echo(json_encode(array("message" => "failed: id empty")));
        return;
      }
      $content = file_get_contents("../ticketData/classes.json");
      $content = json_decode($content, true);
      $newcontent = array();
      foreach ($content as &$entry) {
        if (!isset($entry['id']) || !($entry['id'] == $id)) { // !(a&&b) = (!a||!b)
          $newcontent[] = $entry;
        }
      }
      file_put_contents("../ticketData/classes.json", json_encode($newcontent));
      echo(json_encode(array("message" => "done".$found)));
  } else {
    echo(file_get_contents("../ticketData/classes.json"));
  }
 ?>
 