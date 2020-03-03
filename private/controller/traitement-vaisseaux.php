<?php

$id = lireSession("id_user");

$vaisseau  = filtrerInfo("nomVaisseau");
$nbVaisseau = filtrerInfo("nbVaisseau");

$dateDebut = date("Y-m-d H:i:s");

if ($vaisseau == "chasseur") {
    $table = "chasseur";
} else if ($vaisseau == "destroyer") {
    $table = "destroyer";
} else if ($vaisseau == "cuirassé") {
    $table = "cuirassé";
} else if ($vaisseau == "fregate") {
    $table = "fregate";

} else {
    echo "ERREUR DANS INPUT";
}

    $listeLigne  = lireLigneSQL($table, $id, "id_$table");

    foreach($listeLigne as $tabLigne)
    {
        extract($tabLigne);

        $new_nb = $nb + $nbVaisseau;
        $prix_metal = $cost_metal * $nbVaisseau;
        $prix_cristal = $cost_cristal * $nbVaisseau;
        $prix_deut = $cost_deut * $nbVaisseau;
        $upTime = $prod_time * $nbVaisseau;
        $timeUp = date("Y-m-d H:i:s", strtotime ("+$upTime minute"));

    }

    $tabAssoColVal = [
        "nb"               => $new_nb,
    ];   

    $objetPDOStatement = modifierLigneSQL($table, $tabAssoColVal, $id);
    