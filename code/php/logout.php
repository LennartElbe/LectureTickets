<?php
session_start();

global $_SESSION;

if (isset($_SESSION["logged"])) {
   unset($_SESSION["logged"]);
}
header("Location: /applications/User/login.php");

?>