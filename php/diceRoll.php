<?php
    $id = "";
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        echo(json_encode(array("message" => "Error: no id")));
        return;
    }
    $classesContent = file_get_contents("../ticketData/classes.json");
    $classesContent = json_decode($classesContent, true);

    $signupsContent = file_get_contents("../ticketData/signups.json");
    $signupsContent = json_decode($signupsContent, true);
    if (!isset($signupsContent[$id])) {
        echo(json_encode(array("message" => "Error: no id in signups.json")));
        return;
    }
    $changed = false;
    foreach ($classesContent as $class) {
        if (isset($class['id'])) {
            if ($class['id'] == $id) {
                $s = $signupsContent[$id]['signups'];
                $max = $class['classSeatCount'];
                if ($s <= $max) {
                    $signupsContent[$id]['admittances'] = $s;
                } else { // need to select $max many out of $s
                    shuffle($s);
                    $signupsContent[$id]['admittances'] = array_slice($s, 0, $max);
                }
                $changed = true;
                break;
            }
        }
    }
    if ($changed) {
        file_put_contents("../ticketData/signups.json", json_encode($signupsContent));
        echo(json_encode(array("message" => "done")));
    } else {
        echo(json_encode(array("message" => "warning: no changes")));
    }
?>