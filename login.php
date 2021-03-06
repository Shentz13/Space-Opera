<?php require_once "private/controller/traitement.php" ?>

<!DOCTYPE html>
<html lang="fr-FR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Login</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/css/bootstrap-select.min.css">
        <link rel="stylesheet" href="assets/css/login-large.css">
        <script src="https://kit.fontawesome.com/7830cdc0d6.js"></script>
    </head>

    <body>

    <div class="sectionHeader">

<div class="hiddenCircle"><div class="topCircle"><div class="insideCircle"><i class="fas fa-lock"></i></div></div></div>

</div>   

<section>

<h3>VEUILLEZ VOUS IDENTIFIER</h3>

<form action="" id="connexion" method="POST">

<div class="inputContainer">
<div class="backInput">

<label>EMAIL</label>

<input type="email" name="email" placeholder="exemple@email.com" id="email" required>

</div>

<div class="formTrue hidden" id="mailTrue"><i class="far fa-check-circle"></i></div>
<div class="formFalse hidden" id="mailFalse"><i class="fas fa-times"></i></div>

</div>

<div class="inputContainer">
<div class="backInput">

<label>PASSWORD</label>

<input type="password" name="passwordNoHash" id="password" placeholder="De 10 à 30 caractères" required>

</div>

<div class="formTrue hidden" id="passwordTrue"><i class="far fa-check-circle"></i></div>
<div class="formFalse hidden" id="passwordFalse"><i class="fas fa-times"></i></div>

</div>

<div class="btn"><i class="far fa-paper-plane"></i>Valider</div>

<button type="submit" class="btn hidden" id="submit"></button>

<input type="hidden" name="identifiantFormulaire" value="login">

</form>

</section>

<div id="scanContainer" class="hidden">
    <div id="printCont">
        <div id="print"></div>

        <div id="rayonCont">           
            <div class="animateRayonRetour"></div>
            <div id="rayon"></div>
            <div class="animateRayon"></div>
        </div>
    </div>

    <div id="scanner">
        <p id="scanText">SCANNING</p>
        <p id="grantedAccess" class="hidden">ACCESS GRANTED</p>
        <p id="deniedAccess" class="hidden">ACCESS DENIED</p>
        <div id="loading">
            <div id="loadingProgress"></div>
        </div>
    </div>
</div>

<audio id="player" src="./assets/sound/login.wav">
</audio>

<!-- Chargement jQuery -->
<script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
<!-- Chargement Bootstrap -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/js/bootstrap-select.min.js"></script>
<script src=""></script>
<!-- Chargement du code Javascript de la page -->
<script src="login.js"></script>



</body>

</html>

