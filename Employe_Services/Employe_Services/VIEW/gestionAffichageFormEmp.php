<?php

function affichageFormEmpl($action,$disabled,$noemp,$nom,$prenom,$emploi,$sup,$embauche,$sal,$comm,$noserv){ ?>
    <form class="container text-center" action="<?php echo $action?>" method="post">
    
    <div class="row">
        <div class="col-12">
            <label class="label_form" for="NOEMP">NOEMP</label>
            <input type="number" class="form-control" id="NOEMP" name="NOEMP" value="<?php echo $noemp?>"  <?php echo $disabled?> required><br />
        </div>
        
        <div class="col-6">
            <label class="label_form" for="NOM">NOM</label>
            <input type="text" class="form-control" id="NOM" name="NOM" value="<?php echo $nom?>" ><br />
        </div>
        <div class="col-6">
            <label class="label_form" for="PRENOM">PRENOM</label>
        <input type="text" class="form-control" id="PRENOM" name="PRENOM" value="<?php echo $prenom ?>" ><br />
        </div>
        <div class="col-4">
            <label class="label_form" for="EMPLOI">EMPLOI</label>
            <input type="text" class="form-control" id="EMPLOI" name="EMPLOI" value="<?php echo $emploi ?>" ><br />
        </div>
        <div class="col-4">
            <label class="label_form" for="SUP">SUP</label>
            <input type="number" class="form-control" id="SUP" name="SUP" value="<?php echo $sup?>" ><br />
        </div>
        <div class="col-4">
            <label class="label_form" for="EMBAUCHE">EMBAUCHE</label>
            <input type="date" class="form-control" id="EMBAUCHE" name="EMBAUCHE" value="<?php echo $embauche?>" ><br />
        </div>
        <div class="col-6">
            <label class="label_form" for="SAL">SAL</label>
            <input type="number" class="form-control" id="SAL" name="SAL" value="<?php echo $sal?>" ><br />
        </div>
        <div class="col-6">
            <label class="label_form" for="COMM">COMM</label>
            <input type="number" class="form-control" id="COMM" name="COMM" value="<?php echo $comm?>" ><br />
        </div>
        <div class="col-12">
            <label class="label_form" for="NOSERV">NOSERV</label>
            <input type="number" class="form-control" id="NOSERV" name="NOSERV" value="<?php echo $noserv?>" <?php echo $disabled?> required><br />
        </div>
    </div>
    <div class="index_div_btn1"><button type="submit" class="index_btn">Submit</button></div>
</form>
<?php }

function gestionAffichageErreurFormEmploye($eCode) {
    if ($eCode) {
        echo '<style>.xdebug-error {display: none;]</style>
        <div class="alert alert-danger" role="alert">
        Problème technique. Code erreur : '.$eCode.'
      </div>';
    }
}

function htmlHeaderFormEmploye($action,$disabled,$noemp,$nom,$prenom,$emploi,$sup,$embauche,$sal,$comm,$noserv){ ?>
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

<?php affichageFormEmpl($action,$disabled,$noemp,$nom,$prenom,$emploi,$sup,$embauche,$sal,$comm,$noserv); ?>
    
</body>

</html>
<?php }
