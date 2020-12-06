<?php

function btnTabEmploye($compteur)
{ ?>
    <div class="container">
        <div class="row">
            <div class="text-center col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <a href="traitementUser.php"><button class="btn btn-secondary btn-lg mt-5">Accueil</button></a>
            </div>
            <div class="text-center col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <a href="traitementService.php"><button class="btn btn-outline-secondary btn-lg mt-5">Tableau SERVICE</button></a>
            </div>
            <div class="text-center col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <a href="#"><button class="btn btn-secondary btn-lg mt-5">Tableau EMPLOYE</button></a>
            </div>
            <?php if ($_SESSION["user_profil"] == "Admin") { ?>

                <div class="text-center col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <a href="traitementFormEmp.php?action=ajout"><button class="btn btn-success btn-lg mt-5">Ajout</button></a>
                </div>

                <div class="text-center col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <p>Nombre d'employe ajouter aujourd'hui : <?php echo $compteur ?></p>
                </div>
            <?php } ?>
            <div class="text-center col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <label for="">Filtre</label>
                <input type="text" name="nom" id="nomFiltre" placeholder="Nom de l'employe">
                <input type="text" name="prenom" id="prenomFiltre" placeholder="Prenom de l'employe">
                <input type="text" name="emploi" id="emploiFiltre" placeholder="Employe">
                <input type="text" name="nomService" id="serviceFiltre" placeholder="Nom du service">
            </div>
        <?php }

    function tableHeader()
    { ?>
            <table class="table-bordered table-hover text-center">
                <thead class="table">

                    <th>NOEMP</th>
                    <th>NOM</th>
                    <th>PRENOM</th>
                    <th>EMPLOI</th>
                    <th>SUP</th>
                    <th>EMBAUCHE</th>
                    <?php if ($_SESSION["user_profil"] == "Admin") { ?>
                        <th>SAL</th>
                        <th>COMM</th>
                    <?php } ?>
                    <th>NOSERV</th>
                    <?php if ($_SESSION["user_profil"] == "Admin") { ?>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    <?php } ?>
                </thead>
        </div>
    </div>
<?php }

    function bodyTabEmploye($data, $supTabEmploye)
    {

        foreach ($data as $value) {

            echo
                "<tr>

        <td class='tdData'>" . $value->getNoemp() . "</td>
        <td class='tdData'>" . $value->getNom() . "</td>
        <td class='tdData'>" . $value->getPrenom() . "</td>
        <td class='tdData'> " . $value->getEmploi() . "</td>
        <td class='tdData'>" . $value->getSup() . "</td>
        <td class='tdData'>" . $value->getEmbauche() . "</td>";
            if ($_SESSION["user_profil"] == "Admin") {
                echo "<td class='tdData'>" . $value->getSal() . "</td>
            <td class='tdData'>" . $value->getComm() . "</td>";
            }
            echo "<td class='tdData'>" . $value->getNoserv() . "</td>";

            if ($_SESSION["user_profil"] == "Admin") {
                echo '<td> <a href="traitementFormEmp.php?action=modif&NOEMP=' . $value->getNoemp() . '&NOSERV=' . $value->getNoserv() . '"><button class="btn btn-primary">Modifier les informations</button></a> </td>';
                if (!array_search($value->getNoemp(), $supTabEmploye)) {

                    echo '<td> <a href="traitementEmploye.php?action=delete&NOEMP=' . $value->getNoemp() . '"><button class="btn btn-danger">Supprimer la ligne</button></a> </td>';
                }
            }
            echo "</tr>";
        }
    }

    function gestionAffichageErreurEmploye($eCode)
    {
        if ($eCode) {
            echo '<style>.xdebug-error {display: none;]</style>
        <div class="alert alert-danger" role="alert">
        Problème technique. Code erreur : ' . $eCode . '
      </div>';
        }
    }

    function htmlHeaderEmploye($data, $supTabEmploye, $compteur)
    { ?>
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
        <div id="test">
            <?php
            btnTabEmploye($compteur);
            tableHeader();
            bodyTabEmploye($data, $supTabEmploye);
            ?>
            
            <script type="text/javascript">var session="<?php echo $_SESSION["user_profil"]?>"</script>
            <script src="../jquery-3.5.1.min.js"></script>
            <script type="text/javascript" src="../script.js"></script>
        </div>
    </body>

    </html>
<?php } ?>