<?php

$id = lireSession("id_user");

$minerai  = filtrerInfo("mineraiHidden");

$cristal  = filtrerInfo("cristalHidden");

$deuterium  = filtrerInfo("deuteriumHidden");

$poussiere  = filtrerInfo("poussiereHidden");

$matiere  = filtrerInfo("matiereHidden");

$mineMinerai  = filtrerInfo("stockMineMineraiHidden");

$mineCristal  = filtrerInfo("stockMineCristalHidden");

$mineDeuterium  = filtrerInfo("stockMineDeuteriumHidden");

$minePoussiere  = filtrerInfo("stockMinePoussiereHidden");

$mineMatiere  = filtrerInfo("stockMineMatiereHidden");

$dateMaj = date("Y-m-d H:i:s");

if($minerai != "") {

    $listeLigne  = lireLigneSQL("minerai", $id, "id_minerai");

    foreach($listeLigne as $tabLigne)
    {
        extract($tabLigne);

        $stockTotal = $stock; 
        
        //if ($mineMinerai < $capaciteMine)
    }

    $tabAssoColVal = [
        "stock"         => $minerai,
        "stock_mine"    => $mineMinerai,
        "date"          => $dateMaj,
    ];   

    $objetPDOStatement = modifierLigneSQL("minerai", $tabAssoColVal, $id);
    
} else {

}

if ($cristal != "") {

    $listeLigne  = lireLigneSQL("cristal", $id, "id_cristal");

    foreach($listeLigne as $tabLigne)
    {
        extract($tabLigne);

        $stockTotal = $stock; 

    }

    $tabAssoColVal = [
        "stock"         => $cristal,
        "stock_mine"    => $mineCristal,
        "date"          => $dateMaj,
    ];   

    $objetPDOStatement = modifierLigneSQL("cristal", $tabAssoColVal, $id);

} else {

}

if($deuterium != "") {

    $listeLigne  = lireLigneSQL("deuterium", $id, "id_deuterium");

    foreach($listeLigne as $tabLigne)
    {
        extract($tabLigne);

        $stockTotal = $stock; 

    }

    $tabAssoColVal = [
        "stock"         => $deuterium,
        "stock_mine"    => $mineDeuterium,
        "date"          => $dateMaj,
    ];   

    $objetPDOStatement = modifierLigneSQL("deuterium", $tabAssoColVal, $id);

} else {

}

if($poussiere != "") {

    $listeLigne  = lireLigneSQL("poussiere", $id, "id_poussiere");

    foreach($listeLigne as $tabLigne)
    {
        extract($tabLigne);

        $stockTotal = $stock; 
    }

    $tabAssoColVal = [
        "stock"         => $poussiere,
        "stock_mine"    => $minePoussiere,
        "date"          => $dateMaj,
    ];   

    $objetPDOStatement = modifierLigneSQL("poussiere", $tabAssoColVal, $id);

} else {

}

if($matiere != "") {

    $listeLigne  = lireLigneSQL("matiere", $id, "id_matiere");

    foreach($listeLigne as $tabLigne)
    {
        extract($tabLigne);

        $stockTotal = $stock; 
    }

    $tabAssoColVal = [
        "stock"         => $matiere,
        "stock_mine"    => $mineMatiere,
        "date"          => $dateMaj,
    ];   

    $objetPDOStatement = modifierLigneSQL("matiere", $tabAssoColVal, $id);

} else {

}
