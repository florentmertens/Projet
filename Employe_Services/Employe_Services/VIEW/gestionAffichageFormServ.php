<?php

function affichageFormServ($action,$disabled,$noserv,$service,$ville){ ?>
    <form class="container text-center" action="<?php echo $action?>" method="post">
            <div class="row">
                <div class="col-12">
                    <label class="label_form" for="NOSERV">NOSERV</label>
                    <input type="number" class="form-control" id="NOSERV" name="NOSERV" value="<?php echo $noserv?>" <?php echo $disabled?> required><br />
                </div>
                <div class="col-12">
                    <label class="label_form" for="SERVICE">SERVICE</label>
                    <input type="text" class="form-control" id="SERVICE" name="SERVICE" value="<?php echo $service?>"><br />
                </div>
                <div class="col-12">
                    <label class="label_form" for="VILLE">VILLE</label>
                    <input type="text" class="form-control" id="VILLE" name="VILLE" value="<?php echo $ville?>"><br />
                </div>
            </div>
            <div class="index_div_btn1"><button type="submit" class="index_btn">Submit</button></div>
        </form>
<?php }

function gestionAffichageErreurFormService($eCode) {
    if ($eCode) {
        echo '<style>.xdebug-error {display: none;]</style>
        <div class="alert alert-danger" role="alert">
        Problème technique. Code erreur : '.$eCode.'
      </div>';
    }
}

function htmlHeaderFormService($action,$disabled,$noserv,$service,$ville){ ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/mysqlicss.css">
</head>

<body style="background-image: url(../style/image/building-1210022_1920.jpg)">

<?php affichageFormServ($action,$disabled,$noserv,$service,$ville); ?>

</body>

</html>
<?php } ?>