<?php
function affichageFormUser($action){ ?>
    <form class="container text-center" action="<?php echo $action?>" method="POST">
        <div class="row">
            <div class="col-12">
                <label class="label_form" for="user">User Name</label>
                <input type="user" class="form-control" id="userName" name="userName" required>
            </div>
            <div class="col-12">
                <label class="label_form" for="password">Password</label>
                <input type="password" class="form-control" id="userPassword" name="userPassword" required>
            </div>
        </div>
        <div class="index_div_btn1"><button type="submit" class="index_btn">Submit</button></div>
    </form>'
<?php }

function gestionAffichageErreurFormUser($eCode){
    if ($eCode===1) {
        echo '<style>.xdebug-error {display: none;]</style>
            <div class="alert alert-danger" role="alert">
            Votre user name ou votre password n\'est pas valide.
          </div>';
    } elseif ($eCode===2) {
        echo '<style>.xdebug-error {display: none;]</style>
            <div class="alert alert-danger" role="alert">
            l\'user name saisi est déjà utilisé.
          </div>';
    } else {
        echo '<style>.xdebug-error {display: none;]</style>
            <div class="alert alert-danger" role="alert">
            Problème technique. Code erreur : '.$eCode.'
          </div>';
    }
}


function htmlHeaderFormUser($action){ ?>
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/mysqlicss.css">
</head>

<body style="background-image: url(../style/image/building-1210022_1920.jpg)">
    <?php affichageFormUser($action); ?>

</body>

</html>
<?php } ?>