<?php
session_start();
if (isset($_GET["action"]) && !empty($_GET["action"]) && $_GET["action"] == "deconnexion") {
    session_destroy();
    header('Location: traitementUser.php');
}
include_once('../SERVICE_MYSQLI/UserMysqliService.php');
include_once('../VIEW/gestionAffichageIndex.php');
include_once('../VIEW/gestionAffichageFormUser.php');

$userService = new UserMysqliService();
$user = new User();

if (
    isset($_GET["action"]) && !empty($_GET["action"] && $_GET["action"] == "connexion")
    && isset($_POST["userName"]) && !empty($_POST["userName"])
    && isset($_POST["userPassword"]) && !empty($_POST["userPassword"])
) {
    $userName = htmlentities($_POST["userName"]);
    $userPassword = htmlentities($_POST["userPassword"]);
    $user->setUserName($userName)->setUserPassword($userPassword);
    try {
        $userData = $userService->rechercheUser($user);
        if (isset($userData)) {
            $connexionData = $userService->connexion($user, $userData);
            if (isset($connexionData)) {
                $_SESSION["userName"] = $connexionData["USERNAME"];
                $_SESSION["user_profil"] = $connexionData["PROFIL"];
                htmlHeaderIndex();
            } else {
                gestionAffichageErreurFormUser($e = 1);
                htmlHeaderFormUser($action = "traitementUser.php?action=connexion");
            }
        } else {
            gestionAffichageErreurFormUser($e = 1);
            htmlHeaderFormUser($action = "traitementUser.php?action=connexion");
        }
    } catch (ServiceException $e) {
        gestionAffichageErreurFormUser($e->getCode());
        htmlHeaderFormUser($action = "traitementUser.php?action=connexion");
    }
} elseif (
    isset($_GET["action"]) && !empty($_GET["action"] && $_GET["action"] == "inscription")
    && isset($_POST["userName"]) && !empty($_POST["userName"])
    && isset($_POST["userPassword"]) && !empty($_POST["userPassword"])
) {
    $userName = htmlentities($_POST["userName"]);
    $userPassword = htmlentities($_POST["userPassword"]);
    $user->setUserName($userName)->setUserPassword($userPassword);
    try {
        $userData = $userService->rechercheUser($user);
        if (!isset($userData)) {
            $userService->inscriptionUser($user);
            htmlHeaderIndex();
        } else {
            gestionAffichageErreurFormUser($e = 2);
            htmlHeaderFormUser($action = "traitementUser.php?action=inscription");
        }
    } catch (ServiceException $e) {
        gestionAffichageErreurFormUser($e->getCode());
        htmlHeaderFormUser($action = "traitementUser.php?action=inscription");
    }
} else {
    htmlHeaderIndex();
}
