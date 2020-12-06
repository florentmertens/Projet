<?php

function btnTabService(){ ?>
    <div class="container">
            <div class="row">
                <div class="text-center col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <a href="traitementUser.php"><button class="btn btn-secondary btn-lg mt-5">Accueil</button></a>
                </div>
                <div class="text-center col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <a href="#"><button class="btn btn-secondary btn-lg mt-5">Tableau SERVICE</button></a>
                </div>
                <div class="text-center col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <a href="traitementEmploye.php"><button class="btn btn-outline-secondary btn-lg mt-5">Tableau EMPLOYE</button></a>
                </div>
                <?php if ($_SESSION["user_profil"] == "Admin") { ?>
                    
                    <div class="text-center col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <a href="traitementFormServ.php?action=ajout"><button class="btn btn-success btn-lg mt-5">Ajout</button></a>
                    </div>
                <?php }
}

function tableHeader(){ ?>
    <table class="table-bordered table-hover text-center">
                    <thead class="table">
                        <td>NOSERV</td>
                        <td>SERVICE</td>
                        <td>VILLE</td>
                        <?php if ($_SESSION["user_profil"] == "Admin") { ?>
                            
                            <td>Modifier les informations</td>
                            <td>Supprimer</td>
                       <?php } ?>
                    </thead>
            </div>
        </div>
<?php }

function bodyTabService($data,$getAffectedServices){

    foreach ($data as $value) {

        echo
            "<tr>
        <td>" . $value->getNoserv() . "</td>
        <td>" . $value->getService() . "</td>
        <td>" . $value->getVille() . "</td>";
        if ($_SESSION["user_profil"] == "Admin") {
            echo '<td> <a href="traitementFormServ.php?action=modif&NOSERV=' . $value->getNoserv() . '"><button class="btn btn-primary">Modifier les informations</button></a> </td>';
            if (!array_search($value->getNoserv(), $getAffectedServices)) {
                echo '<td> <a href="traitementService.php?action=delete&NOSERV=' . $value->getNoserv() . '"><button class="btn btn-danger">Supprimer la ligne</button></a> </td>';
            }
        }
        echo "</tr>";
    }
}

function gestionAffichageErreurService($eCode) {
    if ($eCode) {
        echo '<style>.xdebug-error {display: none;]</style>
        <div class="alert alert-danger" role="alert">
        Problème technique. Code erreur : '.$eCode.'
      </div>';
    }
}

function htmlHeaderService($data,$getAffectedServices){?>
    
    <!DOCTYPE html>
    <html lang="fr">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link rel="stylesheet" href="../style/mysqlicss.css">
    </head>
    
    <body>
    
        <?php
        btnTabService();
        tableHeader();
        bodyTabService($data,$getAffectedServices);
        ?>
    
    </body>
    
    </html>
<?php } ?>