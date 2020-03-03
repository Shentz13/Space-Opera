<?php

$id = lireSession("id_user");

$batiment  = filtrerInfo("upgradeOfBatiment");

$dateDebut = date("Y-m-d H:i:s");

if ($batiment == "mineMinerai") {
    $table = "minerai";
} else if ($batiment == "mineCristal") {
    $table = "cristal";
} else if ($batiment == "mineDeuterium") {
    $table = "deuterium";
} else if ($batiment == "minePoussiereEtoile") {
    $table = "poussiere";
} else if ($batiment == "mineMatiereNoire") {
    $table = "matiere";
} else {
    echo "ERREUR DANS INPUT";
}

    $listeLigne  = lireLigneSQL($table, $id, "id_$table");

    foreach($listeLigne as $tabLigne)
    {
        extract($tabLigne);

        $new_prod = (round($prod_min, 2) + (round($prod_min, 2) / 4));
        $new_capa = ($capacite_mine + ($capacite_mine / 3));
        $new_capa_rounded = round($new_capa, 2);
        $upTime = ($temps_upgrade * 2);
        $timeUp = date("Y-m-d H:i:s", strtotime ("+$upTime minute"));

    }

    $tabAssoColVal = [
        "prod_min"         => $new_prod,
        "capacite_mine"    => $new_capa_rounded,
        "niveau_mine"      => $niveau_mine +1,
        "temps_upgrade"    => $upTime,
        "date_fin_upgrade" => $timeUp,
    ];   

    $objetPDOStatement = modifierLigneSQL($table, $tabAssoColVal, $id);
    
