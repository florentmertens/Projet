<?php
session_start();
if (empty($_SESSION)) {
    header("Location: traitementUser.php");
}
include_once('../SERVICE_MYSQLI/EmployeMysqliService.php');
include_once('../VIEW/gestionAffichageEmploye.php');
include_once('../VIEW/gestionAffichageFormEmp.php');

$employeService = new EmployeMysqliService();
$employe = new Employe();


if (
    isset($_GET["action"]) && !empty($_GET["action"]) && $_GET["action"] === "ajout"
    && isset($_POST["NOEMP"]) && !empty($_POST["NOEMP"]) && isset($_POST["NOSERV"]) && !empty($_POST["NOSERV"])
) {
    $noemp = htmlentities($_POST["NOEMP"]);
    $nom = htmlentities($_POST["NOM"]);
    $prenom = htmlentities($_POST["PRENOM"]);
    $emploi = htmlentities($_POST["EMPLOI"]);
    $sup = htmlentities($_POST["SUP"]);
    $embauche = htmlentities($_POST["EMBAUCHE"]);
    $sal = htmlentities($_POST["SAL"]);
    $comm = htmlentities($_POST["COMM"]);
    $noserv = htmlentities($_POST["NOSERV"]);
    $employe->setNoEmp(intval($noemp))->setNom($nom)->setPrenom($prenom)->setEmploi($emploi)->setSup($sup ? $sup : null)->setEmbauche($embauche)->setSal(floatval($sal))->setComm(floatval($comm))->setNoServ(intval($noserv));
    try {
        $employeService->add($employe);
        $compteur = $employeService->count();
        $data = $employeService->rechercheTous();
        $getAffectedSup = $employeService->getAffectedSup();
        htmlHeaderEmploye($data, $getAffectedSup, $compteur);
    } catch (ServiceException $e) {
        gestionAffichageErreurFormEmploye($e->getMessage());
        htmlHeaderFormEmploye($action = "traitementEmploye.php?action=ajout", $disabled = null, $employe->getNoEmp(), $employe->getNom(), $employe->getPrenom(), $employe->getEmploi(), $employe->getSup(), $employe->getEmbauche(), $employe->getSal(), $employe->getComm(), $employe->getNoServ());
    }
} elseif (
    isset($_GET["action"]) && !empty($_GET["action"]) && $_GET["action"] === "modif"
    && isset($_GET["NOEMP"]) && !empty($_GET["NOEMP"])
) {
    $noemp = htmlentities($_GET["NOEMP"]);
    $nom = htmlentities($_POST["NOM"]);
    $prenom = htmlentities($_POST["PRENOM"]);
    $emploi = htmlentities($_POST["EMPLOI"]);
    $sup = htmlentities($_POST["SUP"]);
    $embauche = htmlentities($_POST["EMBAUCHE"]);
    $sal = htmlentities($_POST["SAL"]);
    $comm = htmlentities($_POST["COMM"]);
    $noserv = htmlentities($_GET["NOSERV"]);
    $employe->setNoEmp(intval($noemp))->setNom($nom)->setPrenom($prenom)->setEmploi($emploi)->setSup($sup ? $sup : null)->setEmbauche($embauche)->setSal(floatval($sal))->setComm(floatval($comm))->setNoServ(intval($noserv));
    try {
        $employeService->update($employe);
        $compteur = $employeService->count();
        $data = $employeService->rechercheTous();
        $getAffectedSup = $employeService->getAffectedSup();
        htmlHeaderEmploye($data, $getAffectedSup, $compteur);
    } catch (ServiceException $e) {
        gestionAffichageErreurFormEmploye($e->getCode());
        htmlHeaderFormEmploye($action = "traitementEmploye.php?action=modif&NOEMP=" . $employe->getNoEmp() . "&NOSERV=" . $employe->getNoServ() . "", $disabled = "disabled", $employe->getNoEmp(), $employe->getNom(), $employe->getPrenom(), $employe->getEmploi(), $employe->getSup(), $employe->getEmbauche(), $employe->getSal(), $employe->getComm(), $employe->getNoServ());
    }
} elseif (isset($_GET["action"]) && $_GET["action"] === "delete" && isset($_GET["NOEMP"]) && !empty($_GET["NOEMP"])) {
    try {
        $noemp = htmlentities($_GET["NOEMP"]);
        $employeService->supp($noemp);
        $compteur = $employeService->count();
        $data = $employeService->rechercheTous();
        $getAffectedSup = $employeService->getAffectedSup();
        htmlHeaderEmploye($data, $getAffectedSup, $compteur);
    } catch (ServiceException $e) {
        gestionAffichageErreurEmploye($e->getCode());
        htmlHeaderEmploye($data, $getAffectedSup, $compteur);
    }
} elseif (isset($_GET["action"]) && !empty($_GET["action"]) && $_GET["action"] === "filtrage") {
    $nom = htmlentities($_GET["NOM"]);
    $prenom = htmlentities($_GET["PRENOM"]);
    $emploi = htmlentities($_GET["EMPLOI"]);
    $service = htmlentities($_GET["SERVICE"]);
    $employe->setNom("%" . $nom . "%")->setPrenom("%" . $prenom . "%")->setEmploi("%" . $emploi . "%");
    $service = "%" . $service . "%";
    $tab = $employeService->affichageFiltrage($employe, $service);
    echo json_encode($tab);
} elseif (isset($_GET["action"]) && !empty($_GET["action"]) && $_GET["action"] === "btnSupp") {
    $getAffectedSup = $employeService->getAffectedSup();
    echo json_encode($getAffectedSup);
} else {
    try {
        $compteur = $employeService->count();
        $data = $employeService->rechercheTous();
        $getAffectedSup = $employeService->getAffectedSup();
        htmlHeaderEmploye($data, $getAffectedSup, $compteur);
    } catch (ServiceException $e) {
        gestionAffichageErreurEmploye($e->getCode());
        htmlHeaderEmploye($data, $getAffectedSup, $compteur);
    }
}
