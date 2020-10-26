<?php
session_start(); /// initialize session
  include("code/php/AC.php");
  $user_name = check_logged(); /// function checks if visitor is logged.
  //echo('<script type="text/javascript"> user_name = "'.$user_name.'"; </script>'."\n");
?>
<!DOCTYPE html>
<HTML>
<HEAD>
<TITLE>PRACTICE</TITLE>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</HEAD>

<BODY>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Green Iguana</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo ($user_name); ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
<?php if(check_role( "admin" )) : ?>
                            <a class="dropdown-item" data-toggle="modal" data-target="#add-new-class-modal" href="#">Vorlesungstermine Hinzufugen</a>
                            <a class="dropdown-item" href="/applications/User/admin.php">User Managment</a>
<?php endif; ?>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/code/php/logout.php">logout</a>
                        </div>
                    </li>
                </ul>
                <!--<form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>-->
            </div>
        </nav>

        <div class="row">
            <div class="col-sm-12">
                <div class="btn-group" style="margin-top: 10px; margin-bottom: 10px;" role="group" aria-label="Basic example">
<?php if(check_role( "admin" )) : ?>
                    <button type="button" id="delete-class-button" title="You can only delete a row after it has been selected. " class="btn btn-secondary">Löschen</button>
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#add-new-class-modal">Neuer Eintrag</button>
<?php endif; ?>
                    <button type="button" id="sign-up-button" title="You can only sign up for a class after it has been selected." class="btn btn-secondary" data-toggle="modal" data-target="#sign-up-student-modal">Für einen Platz bewerben</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Vorlesungsnummer</th>
                            <th>Vorlesungsname</th>
                            <th>Datum</th>
                            <th>Startzeit</th>
                            <th>Endzeit</th>
                            <th>Sitzplätze</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="classes"></tbody>
                </table>
            </div>
        </div>
        
        </div>
    </div>

<?php if(check_role( "admin" )) : ?>

    <div class="modal fade" id="add-new-class-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Vorlesungstermine Hinzüfügen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="add-new-class-name">Vorlesungsname</label>
                        <input type="text" class="form-control" id="add-new-class-name" placeholder="Einführung in die ...">
                    </div>
                    <div class="form-group">
                        <label for="add-new-class-number">Vorlesungsnummer</label>
                        <input type="number" class="form-control" id="add-new-class-number" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="add-new-class-date">Datum der Vorlesung</label>
                        <input type="date" class="form-control" id="add-new-class-date" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="add-new-class-time">Vorlesungsanfang (Zeit)</label>
                        <input type="time" class="form-control" id="add-new-class-start-time" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="add-new-class-end-time">Vorlesungsende (Zeit)</label>
                        <input type="time" class="form-control" id="add-new-class-end-time" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="add-new-class-seats">Anzahl verfügbarer Plätze</label>
                        <input type="number" class="form-control" id="add-new-class-seat-count" placeholder="30">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="add-new-class-save-button" class="btn btn-primary" data-dismiss="modal">Alakazam</button>
            </div>
            </div>
        </div>
    </div>

<?php endif; ?>



    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="libraries/qrCodeLib/qrcode.js" type="text/javascript"></script>
    <script type="text/javascript" src="/js/main.js"></script>
    
</BODY>

</HTML>