<?php require_once "private/controller/traitement.php" ?>

<?php $id = lireSession("id_user");?>

<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Space Opera</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="https://kit.fontawesome.com/7830cdc0d6.js"></script>
</head>

<body>

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

    <main>

        <div id="leftMenu" class="waitingInit">
            <div id="listContainer"></div>
            <div id="buttonLeftMenu">
            </div>
        </div>

        <a href="#"><div class="mines" id="mineMinerai">
        <div class="remplissage"></div>
        <div class="upBatiment"></div>
        </div>
        <span id="mineraiSpan" class="spanR">minerai <span class="percent"></span></span>
        </a>
        <a href="#"><div class="mines" id="mineCristal">
        <div class="remplissage"></div>
        <div class="upBatiment"></div>
        </div>
        <span id="cristalSpan" class="spanR">Cristal <span class="percent"></span></span>
        </a>
        <a href="#"><div class="mines" id="mineDeuterium">
        <div class="remplissage"></div>
        <div class="upBatiment"></div>
        </div>
        <span id="deuteriumSpan" class="spanR">Deuterium <span class="percent"></span></span>
        </a>
        <a href="#"><div class="mines" id="minePoussiereEtoile">
        <div class="remplissage"></div>
        <div class="upBatiment"></div>
        </div>
        <span id="poussiereSpan" class="spanR">Poussière d'étoile <span class="percent"></span></span>
        </a>
        <a href="#"><div class="mines" id="mineMatiereNoire">
        <div class="remplissage"></div>
        <div class="upBatiment"></div>
        </div>
        <span id="matiereSpan" class="spanR">Matière noire <span class="percent"></span></span>
        </a>

        <section id="profilSection" class="hidden">

        <div id="absCont">  
        <div class="progress-circle grey thin" data-value="50"></div>     
            <div id="outCircle"></div>
            <div id="circlePointor"></div>
            <div id="circlePointor2"></div>
            <div id="middleWhiteCircle"></div>
            <div id="energyBoxShadow"></div>
            <div id="energy"></div>
            </div>

            <div id="relCont">       
                <div id="lineContainerTop">
                <div class="energyPath"></div>
                <div id="line1BoxShadow"></div> 
                <div id="line1"></div> 
                <div id="smallCircle"></div>
                <div id="largeCircle"></div>
                <div id="checkEnBS">
                <div id="checkEn"></div>               
                </div>
                <div id="cadreVert"></div>
                
            </div>

            <div id="lineContainerBottom"></div>
            </div>
                
        </section>

        <section id="batimentSection" class="hidden">

        <div id="batimentModal">
            <div id="batimentTitle">
                <h2></h2>
            </div>
            <div id="batimentPicture">
                <div id="jauge"></div>
            </div>
            <div id="batimentCost">
                <div class="benefits" id="ben">
                    <h5>Au prochain niveau:</h5>

                    <?php
                
                require_once "private/model/fonctions-model.php";

$listeBatiment = lireLigneSQL("minerai", $id, "id_minerai");

foreach($listeBatiment as $tabLigne)
{
    extract($tabLigne);

    $prod = round($prod_min, 2)."/min";
    $new_prod = round(($prod_min + ($prod_min / 4)), 2)."/min";;
    $capa = round(($capacite_mine / 1000), 2)."K";
    $new_capa = (($capacite_mine + ($capacite_mine / 3)) / 1000);
    $new_capa_rounded = round($new_capa, 2)."K";
    $cost = round((($capacite_mine / 5)/1000), 2)."K";  
    $intermUpTime = ($temps_upgrade * 2);
    $timeUp = date("Y-m-d H:i:s", strtotime ("+$intermUpTime minute"));

    if($intermUpTime >= 60) {
        $upTime = round((($temps_upgrade * 2)/60), 2)." heures";
    } else {
        $upTime = ($temps_upgrade * 2)." minutes";
    }

    echo
<<<CODEHTML
                    <div class="benefitsContainer hidden" id="mineraiBat">
                        <div class="benefitsTop">
                            <ul class="leftUl">
                                <li>Production par minute:</li>
                                <li>Capacité de stockage:</li>
                            </ul>
                            <ul class="leftCenterUl">
                                <li>$prod</li>
                                <li>$capa</li>
                            </ul>
                            <ul class="rightCenterUl">
                                <li><i class="fas fa-angle-double-right"></i></li>
                                <li><i class="fas fa-angle-double-right"></i></li>
                            </ul>
                            <ul class="rightUl">
                                <li>$new_prod</li>
                                <li>$new_capa_rounded</li>
                            </ul>
                        </div>

                        <div class="benefitsBottom">
                            <ul class="bottomLeftUl">
                                <li>Coût de développement:</li>
                                <li>Temps de développement:</li>
                            </ul>
                            <ul class="bottomRightUl">
                                <li>$cost</li>
                                <li class="dateMark" data-dateMark="$date_fin_upgrade">$upTime</li>
                            </ul>
                        </div>
                    </div>
                

CODEHTML;
}

                ?>

<?php
                
                require_once "private/model/fonctions-model.php";

$listeBatiment = lireLigneSQL("cristal", $id, "id_cristal");

foreach($listeBatiment as $tabLigne)
{
    extract($tabLigne);

    $prod = round($prod_min, 2)."/min";
    $new_prod = round(($prod_min + ($prod_min / 4)), 2)."/min";;
    $capa = round(($capacite_mine / 1000), 2)."K";
    $new_capa = (($capacite_mine + ($capacite_mine / 3)) / 1000);
    $new_capa_rounded = round($new_capa, 2)."K";
    $cost = round((($capacite_mine / 5)/1000), 2)."K";  
    $intermUpTime = ($temps_upgrade * 2);
    $timeUp = date("Y-m-d H:i:s", strtotime ("+$intermUpTime minute"));

    if($intermUpTime >= 60) {
        $upTime = round((($temps_upgrade * 2)/60), 2)." heures";
    } else {
        $upTime = ($temps_upgrade * 2)." minutes";
    }

    echo
<<<CODEHTML
                    <div class="benefitsContainer hidden" id="cristalBat">
                        <div class="benefitsTop">
                            <ul class="leftUl">
                                <li>Production par minute:</li>
                                <li>Capacité de stockage:</li>
                            </ul>
                            <ul class="leftCenterUl">
                                <li>$prod</li>
                                <li>$capa</li>
                            </ul>
                            <ul class="rightCenterUl">
                                <li><i class="fas fa-angle-double-right"></i></li>
                                <li><i class="fas fa-angle-double-right"></i></li>
                            </ul>
                            <ul class="rightUl">
                                <li>$new_prod</li>
                                <li>$new_capa_rounded</li>
                            </ul>
                        </div>

                        <div class="benefitsBottom">
                            <ul class="bottomLeftUl">
                                <li>Coût de développement:</li>
                                <li>Temps de développement:</li>
                            </ul>
                            <ul class="bottomRightUl">
                                <li>$cost</li>
                                <li class="dateMark" data-dateMark="$date_fin_upgrade">$upTime</li>
                            </ul>
                        </div>
                    </div>

CODEHTML;
}

                ?>

<?php
                
                require_once "private/model/fonctions-model.php";

$listeBatiment = lireLigneSQL("deuterium", $id, "id_deuterium");

foreach($listeBatiment as $tabLigne)
{
    extract($tabLigne);

    $prod = round($prod_min, 2)."/min";
    $new_prod = round(($prod_min + ($prod_min / 4)), 2)."/min";;
    $capa = round(($capacite_mine / 1000), 2)."K";
    $new_capa = (($capacite_mine + ($capacite_mine / 3)) / 1000);
    $new_capa_rounded = round($new_capa, 2)."K";
    $cost = round((($capacite_mine / 5)/1000), 2)."K";  
    $intermUpTime = ($temps_upgrade * 2);
    $timeUp = date("Y-m-d H:i:s", strtotime ("+$intermUpTime minute"));

    if($intermUpTime >= 60) {
        $upTime = round((($temps_upgrade * 2)/60), 2)." heures";
    } else {
        $upTime = ($temps_upgrade * 2)." minutes";
    }

    echo
<<<CODEHTML
                    <div class="benefitsContainer hidden" id="deuteriumBat">
                        <div class="benefitsTop">
                            <ul class="leftUl">
                                <li>Production par minute:</li>
                                <li>Capacité de stockage:</li>
                            </ul>
                            <ul class="leftCenterUl">
                                <li>$prod</li>
                                <li>$capa</li>
                            </ul>
                            <ul class="rightCenterUl">
                                <li><i class="fas fa-angle-double-right"></i></li>
                                <li><i class="fas fa-angle-double-right"></i></li>
                            </ul>
                            <ul class="rightUl">
                                <li>$new_prod</li>
                                <li>$new_capa_rounded</li>
                            </ul>
                        </div>

                        <div class="benefitsBottom">
                            <ul class="bottomLeftUl">
                                <li>Coût de développement:</li>
                                <li>Temps de développement:</li>
                            </ul>
                            <ul class="bottomRightUl">
                                <li>$cost</li>
                                <li class="dateMark" data-dateMark="$date_fin_upgrade">$upTime</li>
                            </ul>
                        </div>
                    </div>

CODEHTML;
}

                ?>

<?php
                
                require_once "private/model/fonctions-model.php";

$listeBatiment = lireLigneSQL("poussiere", $id, "id_poussiere");

foreach($listeBatiment as $tabLigne)
{
    extract($tabLigne);

    $prod = round($prod_min, 2)."/min";
    $new_prod = round(($prod_min + ($prod_min / 4)), 2)."/min";;
    $capa = round(($capacite_mine / 1000), 2)."K";
    $new_capa = (($capacite_mine + ($capacite_mine / 3)) / 1000);
    $new_capa_rounded = round($new_capa, 2)."K";
    $cost = round((($capacite_mine / 5)/1000), 2)."K";  
    $intermUpTime = ($temps_upgrade * 2);
    $timeUp = date("Y-m-d H:i:s", strtotime ("+$intermUpTime minute"));

    if($intermUpTime >= 60) {
        $upTime = round((($temps_upgrade * 2)/60), 2)." heures";
    } else {
        $upTime = ($temps_upgrade * 2)." minutes";
    }

    echo
<<<CODEHTML
                    <div class="benefitsContainer hidden" id="poussiereBat">
                        <div class="benefitsTop">
                            <ul class="leftUl">
                                <li>Production par minute:</li>
                                <li>Capacité de stockage:</li>
                            </ul>
                            <ul class="leftCenterUl">
                                <li>$prod</li>
                                <li>$capa</li>
                            </ul>
                            <ul class="rightCenterUl">
                                <li><i class="fas fa-angle-double-right"></i></li>
                                <li><i class="fas fa-angle-double-right"></i></li>
                            </ul>
                            <ul class="rightUl">
                                <li>$new_prod</li>
                                <li>$new_capa_rounded</li>
                            </ul>
                        </div>

                        <div class="benefitsBottom">
                            <ul class="bottomLeftUl">
                                <li>Coût de développement:</li>
                                <li>Temps de développement:</li>
                            </ul>
                            <ul class="bottomRightUl">
                                <li>$cost</li>
                                <li class="dateMark" data-dateMark="$date_fin_upgrade">$upTime</li>
                            </ul>
                        </div>
                    </div>

CODEHTML;
}

                ?>

<?php
                
                require_once "private/model/fonctions-model.php";

$listeBatiment = lireLigneSQL("matiere", $id, "id_matiere");

foreach($listeBatiment as $tabLigne)
{
    extract($tabLigne);

    $prod = round($prod_min, 2)."/min";
    $new_prod = round(($prod_min + ($prod_min / 4)), 2)."/min";;
    $capa = round(($capacite_mine / 1000), 2)."K";
    $new_capa = (($capacite_mine + ($capacite_mine / 3)) / 1000);
    $new_capa_rounded = round($new_capa, 2)."K";
    $cost = round((($capacite_mine / 5)/1000), 2)."K";  
    $intermUpTime = ($temps_upgrade * 2);
    $timeUp = date("Y-m-d H:i:s", strtotime ("+$intermUpTime minute"));

    if($intermUpTime >= 60) {
        $upTime = round((($temps_upgrade * 2)/60), 2)." heures";
    } else {
        $upTime = ($temps_upgrade * 2)." minutes";
    }

    echo
<<<CODEHTML
                    <div class="benefitsContainer hidden" id="matiereBat">
                        <div class="benefitsTop">
                            <ul class="leftUl">
                                <li>Production par minute:</li>
                                <li>Capacité de stockage:</li>
                            </ul>
                            <ul class="leftCenterUl">
                                <li>$prod</li>
                                <li>$capa</li>
                            </ul>
                            <ul class="rightCenterUl">
                                <li><i class="fas fa-angle-double-right"></i></li>
                                <li><i class="fas fa-angle-double-right"></i></li>
                            </ul>
                            <ul class="rightUl">
                                <li>$new_prod</li>
                                <li>$new_capa_rounded</li>
                            </ul>
                        </div>

                        <div class="benefitsBottom">
                            <ul class="bottomLeftUl">
                                <li>Coût de développement:</li>
                                <li>Temps de développement:</li>
                            </ul>
                            <ul class="bottomRightUl">
                                <li>$cost</li>
                                <li class="dateMark" data-dateMark="$date_fin_upgrade">$upTime</li>
                            </ul>
                        </div>
                    </div>

CODEHTML;
}

                ?>


                </div>
                    <div class="btnContainer">
                        <h5></h5>
                        <div class="btnWrapper">
                        <div class="btn btn-valid" id="btnUpBatiment">
                            <p>Améliorer</p>
                        </div>

                        <div class="btn btn-close" id="btnCloseBatiment">
                            <p>Fermer</p>
                        </div>
                        </div>
                    </div>
            </div>
        </div>
                
        </section>

        <form action="" method="POST" class="hidden" id="formData">

        <?php 
                
                require_once "private/model/fonctions-model.php";

$listeMinerai = lireLigneSQL("minerai", $id, "id_minerai");

foreach($listeMinerai as $tabLigne)
{
    extract($tabLigne);

    echo
<<<CODEHTML

<input type="text" class="dataInput" name="mineraiHidden" id="mineraiHidden" data-date="$date" data-capaMine="$capacite_mine" data-capaTotale="$capacite_max" data-prod="$prod_min" data-stockTotal="$stock" data-stockMine="$stock_mine" data-tempsUpgrade="$temps_upgrade"/>

CODEHTML;
}

                ?>

<?php 
                
                require_once "private/model/fonctions-model.php";

$listeCristal = lireLigneSQL("cristal", $id, "id_cristal");

foreach($listeCristal as $tabLigne)
{
    extract($tabLigne);

    echo
<<<CODEHTML

<input type="text" class="dataInput" name="cristalHidden" id="cristalHidden" data-date="$date" data-capaMine="$capacite_mine" data-capaTotale="$capacite_max" data-prod="$prod_min" data-stockTotal="$stock" data-stockMine="$stock_mine" data-tempsUpgrade="$temps_upgrade"/>

CODEHTML;
}

                ?>

<?php 
                
                require_once "private/model/fonctions-model.php";

$listeDeuterium = lireLigneSQL("deuterium", $id, "id_deuterium");

foreach($listeDeuterium as $tabLigne)
{
    extract($tabLigne);

    echo
<<<CODEHTML

<input type="text" class="dataInput" name="deuteriumHidden" id="deuteriumHidden" data-date="$date" data-capaMine="$capacite_mine" data-capaTotale="$capacite_max" data-prod="$prod_min" data-stockTotal="$stock" data-stockMine="$stock_mine" data-tempsUpgrade="$temps_upgrade"/>

CODEHTML;
}

                ?>

<?php 
                
                require_once "private/model/fonctions-model.php";

$listePoussiere = lireLigneSQL("poussiere", $id, "id_poussiere");

foreach($listePoussiere as $tabLigne)
{
    extract($tabLigne);

    echo
<<<CODEHTML

<input type="text" class="dataInput" name="poussiereHidden" id="poussiereHidden" data-date="$date" data-capaMine="$capacite_mine" data-capaTotale="$capacite_max" data-prod="$prod_min" data-stockTotal="$stock" data-stockMine="$stock_mine" data-tempsUpgrade="$temps_upgrade"/>

CODEHTML;
}

                ?>

<?php 
                
                require_once "private/model/fonctions-model.php";

$listeMatiere = lireLigneSQL("matiere", $id, "id_matiere");

foreach($listeMatiere as $tabLigne)
{
    extract($tabLigne);

    echo
<<<CODEHTML

<input type="text" class="dataInput" name="matiereHidden" id="matiereHidden" data-date="$date" data-capaMine="$capacite_mine" data-capaTotale="$capacite_max" data-prod="$prod_min" data-stockTotal="$stock" data-stockMine="$stock_mine" data-tempsUpgrade="$temps_upgrade"/>

CODEHTML;
}

                ?>
                
                <input type="text" name="stockMineMineraiHidden" id="stockMineMineraiHidden"/>
                <input type="text" name="stockMineCristalHidden" id="stockMineCristalHidden"/>
                <input type="text" name="stockMineDeuteriumHidden" id="stockMineDeuteriumHidden"/>
                <input type="text" name="stockMinePoussiereHidden" id="stockMinePoussiereHidden"/>
                <input type="text" name="stockMineMatiereHidden" id="stockMineMatiereHidden"/>       

                <button type="submit" class="btn" id="submitRessources"></button>

                <input type="hidden" name="identifiantFormulaire" value="ressources">
        </form>

        <form action="" method="POST" class="hidden">

            <input type="text" name="upgradeOfBatiment" id="upgradeOfBatiment"/>      

            <button type="submit" class="btn" id="submitBatiment"></button>

            <input type="hidden" name="identifiantFormulaire" value="batiments">
        
        </form>

    </main>

    <footer>
        <div class="linkCont"><a href="hangar.php">HANGAR</a></div>
        <div class="linkCont"><a href="#">LINK</a></div>
        <div class="linkCont"><a href="#">LINK</a></div>
        <div class="linkCont"><a href="#">LINK</a></div>
    </footer>

    <audio id="player" src="./assets/sound/sound_hover_mines.wav">
</audio>

    <!-- Chargement jQuery -->
    <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
    <!-- <script src="http://code.jquery.com/jquery-3.3.1.min.js"></script> -->
    <!-- Chargement Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"
        integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/js/bootstrap-select.min.js"></script>
    <!-- Chargement du code Javascript de la page -->
    <script src="script.js"></script>
</body>

</html>