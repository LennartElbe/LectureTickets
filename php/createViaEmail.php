<?php
session_start(); /// initialize sessions
include("../code/php/AC.php");

$user_name = check_logged(); /// function checks if visitor is logged.
echo('<script type="text/javascript"> user_name = "'.$user_name.'"; </script>'."\n");

$allowed = false;
if (check_role( "admin" )) {
  echo('<script type="text/javascript"> role = "admin"; </script>'."\n");    
  $allowed = true;
}

echo('<script type="text/javascript"> role = "admin"; </script>'."\n"); 
$allowed = true;
$studentIdFromURL = "";
if (isset($_GET["studentID"])) {
    $studentIdFromURL = $_GET["studentID"];
}
echo('<script type="text/javascript"> studentIdFromURL = "'.$studentIdFromURL.'"; </script>'."\n");

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Create your student account password.">
<title>Create your student account password.</title>

<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="css/font-awesome.min.css" rel="stylesheet">
<!--<link href="css/bootswatch.css" rel="stylesheet">-->

<link href="//ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/start/jquery-ui.css" rel="stylesheet" type="text/css"/>
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

</head>

<body class="index" id="top" style="padding-top: 70px;">

<div class="navbar navbar-inverse navbar-fixed-top">
<div class="navbar-inner">
<div class="container">
<a class="brand" href="/index.php">Home</a>
<a class="brand" href="/code/php/logout.php">Logout</a>
</div>
</div>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="hero-unit">
                <h1>Create your student account password</h2>
            </div>
            <form>
                <div class="form-group">
                    <label for="create-student-password">New Password</label>
                    <input type="password" class="form-control" id="psw" placeholder="...">
                    <button type="button" style="margin-top: 10px;" id="create-psw-via-email" class="btn btn-primary">Alakazam</button>
                </div>
            </form>
        </div>
    </div>
</div>

    <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> -->
    <script src="//code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.min.js"></script>
    <script type="text/javascript" src="js/tmpl.min.js?_=2345"></script>
    <script type="text/javascript" src="js/md5-min.js"></script>
    <!-- <script type="text/javascript" src="/js/picnet.table.filter.min.js"></script> -->

    <script src="js/bootstrap.min.js"></script>
    <!--<script src="/js/bootswatch.js"></script>-->
    <script type="text/javascript" src="../js/createViaEmail.js"></script>
      </body>
      </html>
      