<?php
session_start();
if (empty($_SESSION)) {
    header("Location: traitementUser.php");
}
include_once('../SERVICE_MYSQLI/ServiceMysqliService.php');
include_once('../VIEW/gestionAffichageService.php');
include_once('../VIEW/gestionAffichageFormServ.php');

$serviceService = new ServiceMysqliService();
$service = new Service();

if (
    isset($_GET["action"]) && !empty($_GET["action"]) && $_GET["action"] == "ajout"
    && isset($_POST["NOSERV"]) && !empty($_POST["NOSERV"])
) {
    $noserv = htmlentities($_POST["NOSERV"]);
    $servicePost = htmlentities($_POST["SERVICE"]);
    $ville = htmlentities($_POST["VILLE"]);
    $service->setNoServ(intval($noserv))->setService($servicePost)->setVille($ville);
    try {
        $serviceService->add($service);
        $data = $serviceService->rechercheTous();
        $getAffectedServices = $serviceService->getAffectedServices();
        htmlHeaderService($data, $getAffectedServices);
    } catch (ServiceException $e) {
        gestionAffichageErreurFormService($e->getCode());
        htmlHeaderFormService($action = "traitementService.php?action=ajout", $disabled = null, $service->getNoServ(), $service->getService(), $service->getVille());
    }
} elseif (
    isset($_GET["action"]) && !empty($_GET["action"]) && $_GET["action"] == "modif"
    && isset($_GET["NOSERV"]) && !empty($_GET["NOSERV"])
) {
    $noserv = htmlentities($_GET["NOSERV"]);
    $servicePost = htmlentities($_POST["SERVICE"]);
    $ville = htmlentities($_POST["VILLE"]);
    $service->setNoServ(intval($noserv))->setService($servicePost)->setVille($ville);
    try {
        $serviceService->update($service);
        $data = $serviceService->rechercheTous();
        $getAffectedServices = $serviceService->getAffectedServices();
        htmlHeaderService($data, $getAffectedServices);
    } catch (ServiceException $e) {
        gestionAffichageErreurFormService($e->getCode());
        htmlHeaderFormService($action = 'traitementService.php?action=modif&NOSERV=' . $service->getNoServ() . '', $disabled = "disabled", $service->getNoServ(), $service->getService(), $service->getVille());
    }
} elseif (isset($_GET["action"]) && $_GET["action"] == "delete" && isset($_GET["NOSERV"]) && !empty($_GET["NOSERV"])) {
    try {
        $noserv = htmlentities($_GET["NOSERV"]);
        $serviceService->supp($noserv);
        $data = $serviceService->rechercheTous();
        $getAffectedServices = $serviceService->getAffectedServices();
        htmlHeaderService($data, $getAffectedServices);
    } catch (ServiceException $e) {
        gestionAffichageErreurService($e->getCode());
        htmlHeaderService($data, $getAffectedServices);
    }
} else {
    try {
        $getAffectedServices = $serviceService->getAffectedServices();
        $data = $serviceService->rechercheTous();
        htmlHeaderService($data, $getAffectedServices);
    } catch (ServiceException $e) {
        gestionAffichageErreurService($e->getCode());
        htmlHeaderService($data, $getAffectedServices);
    }
}
