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
} elseif ($action == "withdraw") {
    $id = "";
    if (isset($_GET['id']))
    $id = $_GET['id'];
    if ($id == "") {
        echo(json_encode(array("message" => "failed: id empty")));
        return;
    }
    $content = file_get_contents("../ticketData/signups.json");
    $content = json_decode($content, true);
    $newcontent = $content;
    $newcontent[$id]["signups"] = [];
    foreach ($content[$id]["signups"] as $student) {
        if ($user_name != $student) {
            $newcontent[$id]["signups"][] = $student;
        }
    }
    file_put_contents("../ticketData/signups.json", json_encode($newcontent));
    echo(json_encode(array("message" => "done")));
} elseif ($action == "delete") {
    $content = file_get_contents("../ticketData/signups.json");
    $content = json_decode($content, true);
    if (!check_role( "admin" )) {
       return;
    }
    $id = "";
      if (isset($_GET['id']))
        $id = $_GET['id'];
      if ($id == "") {
        echo(json_encode(array("message" => "failed: id empty")));
        return;
      }
      $content = file_get_contents("../ticketData/signups.json");
      $content = json_decode($content, true);
      foreach ($content as &$entry) {
        if (isset($content[$id])) {
          unset($content[$id]);
        }
      }
      file_put_contents("../ticketData/signups.json", json_encode($content));
      echo(json_encode(array("message" => "done".$found)));
} else {
    $classesContent = file_get_contents("../ticketData/classes.json");
    $classesContent = json_decode($classesContent, true);
    
    $signupsContent = file_get_contents("../ticketData/signups.json");
    $signupsContent = json_decode($signupsContent, true);
    $data = array();
    foreach ($classesContent as $entry) {
        $status = "";
        if (in_array($user_name, $signupsContent[$entry["id"]]["signups"])) {
            $status = "signed-up";
        }
        $entry["status"] = $status;
        $data[] = $entry;
    }
    echo(json_encode($data));
}

?>
