<?php
session_start();
if (empty($_SESSION)) {
    header("Location: traitementUser.php");
}
include_once('../SERVICE_MYSQLI/ServiceMysqliService.php');
include_once('../VIEW/gestionAffichageFormServ.php');

if (isset($_GET["NOSERV"]) && !empty($_GET["NOSERV"]) && $_GET["action"] == "modif") {
    $serviceService = new ServiceMysqliService();
    $noservGet = htmlentities($_GET["NOSERV"]);
    try {
        $data = $serviceService->recherche1($noservGet);
    } catch (ServiceException $e) {
        gestionAffichageErreurFormService($e->getCode());
        htmlHeaderFormService($action, $disabled, $noserv, $service, $ville);
    }
    $action = 'traitementService.php?action=modif&NOSERV=' . $data->getNoServ() . '';
    $disabled = 'disabled';

    $noserv = $data->getNoServ();
    $service = $data->getService();
    $ville = $data->getVille();
} elseif ($_GET["action"] == "ajout") {

    $action = 'traitementService.php?action=ajout';
    $disabled = null;

    $noserv = null;
    $service = null;
    $ville = null;
}

htmlHeaderFormService($action, $disabled, $noserv, $service, $ville);
