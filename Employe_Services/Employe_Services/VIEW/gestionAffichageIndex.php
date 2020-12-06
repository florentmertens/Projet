<?php

function AffichageIndex()
{
    if (isset($_GET["action"]) && !empty($_GET["action"]) && $_GET["action"] == "inscription") { ?>
        <div class='container-fluid'>
            <div class='row index_div_inscription'>
                <div class='index_div_btn1'><a href='traitementFormUser.php?action=connexion'><button class='index_btn'>Connexion</button></a></div>
            </div>
            <div>
                <p class='index_p'>Bravo vous êtes inscrit. Il faut vous connecter pour accéder aux tableaux employe et service.</p>
            </div>
        </div>
    <?php } elseif (isset($_GET["action"]) && $_GET["action"] == "connexion" || !empty($_SESSION["userName"])) { ?>
        <div class='container-fluid'>
            <div class='row index_div_connexion'>
                <div class='index_div_btn1'><a href='traitementEmploye.php'><button class='index_btn'>Tableau employe</button></a></div>
                <div class='index_div_btn2'><a href='traitementService.php'><button class='index_btn'>Tableau service</button></a></div>
                <div class='index_div_btn3'><a href='traitementUser.php?action=deconnexion'><button class='index_btn'>Deconnexion</button></a></div>
            </div>
            <div class='row'>
                <p class='index_p'>Bonjour vous êtes bien connecté.</p>
            </div>
        </div>
    <?php } else { ?>
        <div class='container-fluid'>
            <div class='row index_div_accueil'>
                <div class='index_div_btn1'><a href='traitementFormUser.php?action=inscription'><button class='index_btn'>Inscription</button></a></div>
                <div class='index_div_btn3'><a href='traitementFormUser.php?action=connexion'><button class='index_btn'>Connexion</button></a></div>
            </div>
            <div class='row'>
                <p class='index_p'>Bonjour vous devez vous inscrire ou vous connectez pour accéder aux tableaux employe et service.</p>
            </div>
        </div>
    <?php }
}

function gestionAffichageErreurIndex($eCode){
    if ($eCode) {
        echo '<style>.xdebug-error {display: none;]</style>
            <div class="alert alert-danger" role="alert">
            Problème technique. Code erreur : '.$eCode.'
          </div>';
    }
}

function htmlHeaderIndex()
{ ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Accueil</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link rel="stylesheet" href="../style/mysqlicss.css">
    </head>

    <body class="index_body">

        <h1 class="index_h1">Accueil</h1>

        <?php AffichageIndex(); ?>

    </body>

    </html>
<?php } ?>