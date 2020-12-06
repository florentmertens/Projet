<?php
session_start();
if (empty($_SESSION)) {
    header("Location: traitementUser.php");
}
include_once('../SERVICE_MYSQLI/EmployeMysqliService.php');
include_once('../VIEW/gestionAffichageFormEmp.php');

if (isset($_GET["NOEMP"]) && !empty($_GET["NOEMP"]) && $_GET["action"] == "modif") {
    $employeService = new EmployeMysqliService();
    $noempGet = htmlentities($_GET["NOEMP"]);
    try {
        $dataFrom = $employeService->recherche1($noempGet);
    } catch (ServiceException $e) {
        gestionAffichageErreurFormEmploye($e->getCode());
        htmlHeaderFormEmploye($action, $disabled, $noemp, $nom, $prenom, $emploi, $sup, $embauche, $sal, $comm, $noserv);
    }
    $action = 'traitementEmploye.php?action=modif&NOEMP=' . $dataFrom->getNoEmp() . '&NOSERV=' . $dataFrom->getNoServ() . '';
    $disabled = 'disabled';

    $noemp = $dataFrom->getNoEmp();
    $nom = $dataFrom->getNom();
    $prenom = $dataFrom->getPrenom();
    $emploi = $dataFrom->getEmploi();
    $sup = $dataFrom->getSup();
    $embauche = $dataFrom->getEmbauche();
    $sal = $dataFrom->getSal();
    $comm = $dataFrom->getComm();
    $noserv = $dataFrom->getNoServ();
    htmlHeaderFormEmploye($action, $disabled, $noemp, $nom, $prenom, $emploi, $sup, $embauche, $sal, $comm, $noserv);
} elseif ($_GET["action"] == "ajout") {

    $action = "traitementEmploye.php?action=ajout";
    $disabled = null;

    $noemp = null;
    $nom = null;
    $prenom = null;
    $emploi = null;
    $sup = null;
    $embauche = null;
    $sal = null;
    $comm = null;
    $noserv = null;
    htmlHeaderFormEmploye($action, $disabled, $noemp, $nom, $prenom, $emploi, $sup, $embauche, $sal, $comm, $noserv);
}
