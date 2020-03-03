<?php require_once "private/controller/traitement.php" ?>

<?php $id = lireSession("id_user");?>

<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Space Opera - Hangar</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="assets/css/styles-hangar.css">

</head>

<body>
  <div id="bodyCont">

<header>
        <div id="profil">
            <div id="avatar">
                <div id="avatarMask"></div>
            </div>
            <div id="playerName">
                <h2>Shentz</h2>
            </div>
        </div>
        <div id="ressources">
            <div class="ressourcesCount" id="mineraiCount">
                <div class="iconRessource">
                <div class="mineraiPics"></div>
                <p class="ressourcesTitle">Minerai</p>
                </div>
                <p class="ressourcesCounter"><?php 
                
                require_once "private/model/fonctions-model.php";

$listeMinerai = lireLigneSQL("minerai", $id, "id_minerai");

foreach($listeMinerai as $tabLigne)
{
    extract($tabLigne);

    echo $stock/1000;

}

                ?> K</p>
            </div>
            <div class="ressourcesCount" id="cristalCount">
                <div class="iconRessource">
                <div class="cristalPics"></div>
                <p class="ressourcesTitle">Cristal</p>
                </div>
                <p class="ressourcesCounter"><?php 
                
                require_once "private/model/fonctions-model.php";

$listeMinerai = lireLigneSQL("cristal", $id, "id_cristal");

foreach($listeMinerai as $tabLigne)
{
    extract($tabLigne);

    echo $stock/1000;

}

                ?> K</p>
            </div>
            <div class="ressourcesCount" id="deuteriumCount">
                <div class="iconRessource">
                <div class="deuteriumPics"></div>
                <p class="ressourcesTitle">Deuterium</p>
                </div>
                <p class="ressourcesCounter"><?php 
                
                require_once "private/model/fonctions-model.php";

$listeMinerai = lireLigneSQL("deuterium", $id, "id_deuterium");

foreach($listeMinerai as $tabLigne)
{
    extract($tabLigne);

    echo $stock/1000;

}

                ?> K</p>
            </div>
            <div class="ressourcesCount" id="poussiereCount">
                <div class="iconRessource">
                <div class="poussierePics"></div>
                <p class="ressourcesTitle">Poussiere</p>
                </div>
                <p class="ressourcesCounter"><?php 
                
                require_once "private/model/fonctions-model.php";

$listeMinerai = lireLigneSQL("poussiere", $id, "id_poussiere");

foreach($listeMinerai as $tabLigne)
{
    extract($tabLigne);

    echo $stock/1000;

}

                ?> K</p>
            </div>
            <div class="ressourcesCount" id="matiereCount">
                <div class="iconRessource">
                <div class="matierePics"></div>
                <p class="ressourcesTitle">Matiere</p>
                </div>
                <p class="ressourcesCounter"><?php 
                
                require_once "private/model/fonctions-model.php";

$listeMinerai = lireLigneSQL("matiere", $id, "id_matiere");

foreach($listeMinerai as $tabLigne)
{
    extract($tabLigne);

    echo $stock/1000;

}

                ?> K</p>
            </div>
        </div>

    </header>

<main class="dCenter">

<div id="carousel" class="carousel slide" data-ride="carousel" data-interval="false">
  <div class="carousel-inner">
    <!--
INJECTION ICI DES SLIDES DU CAROUSEL VIA JS
-->
  </div>
  <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<form action="" method="POST" class="hidden">

<input type="text" name="nomVaisseau" id="nomVaisseau"/>
<input type="text" name="nbVaisseau" id="nbVaisseau"/>       

<button type="submit" class="btn" id="submitBatiment"></button>

<input type="hidden" name="identifiantFormulaire" value="batiments">

</form>

</main>

<footer>
        <div class="linkCont"><a href="accueil.php">ACCUEIL</a></div>
        <div class="linkCont"><a href="#">LINK</a></div>
        <div class="linkCont"><a href="#">LINK</a></div>
        <div class="linkCont"><a href="#">LINK</a></div>
    </footer>

</div>

    <!-- Chargement jQuery -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <!-- Chargement Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/js/bootstrap-select.min.js"></script>
    <!-- Chargement du code Javascript de la page -->
    <script src="script-hangar.js"></script>
</body>

</html>