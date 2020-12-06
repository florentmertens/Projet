<?php
include_once('../SERVICE_MYSQLI/UserMysqliService.php');
include_once('../VIEW/gestionAffichageFormUser.php');

if ($_GET["action"] == "connexion") {

    $action = 'traitementUser.php?action=connexion';
} elseif ($_GET["action"] == "inscription") {
    $action = 'traitementUser.php?action=inscription';
}
htmlHeaderFormUser($action, $userName = null);
