<?php

// MODE DEV
// POUR AFFICHER LES ERREURS
// PHP VA NOUS AIDER EN AFFICHANT LE MAXIMUM D'ERREURS DANS LE NAVIGATEUR
// https://www.php.net/manual/fr/function.error-reporting.php
error_reporting(E_ALL);             // NIVEAU MAXIMUM DE DETECTION DES PROBLEMES
// https://www.php.net/manual/fr/function.ini-set.php
ini_set("display_errors", "1");     // AFFICHER DANS LE NAVIGATEUR LES ERREURS

// CHARGER LES PARAMETRES DE MON PROJET
require_once "private/mon-projet.php";

// TESTER SI IL Y A UN FORMULAIRE A TRAITER
// ON VA DETECTER SI L'INFO identifiantFormulaire EST PRESENTE
// ET SI OUI QUELLE EST SA VALEUR...
// ON A BESOIN DE NOTRE FONCTION filterInfo POUR RECUPERER LES INFOS DES FORMULAIRES
require_once "private/model/fonctions-model.php";
require_once "private/controller/fonctions-controller.php";

// MAINTENANT JE PEUX UTILISER/APPELER LA FONCTION filterInfo
// POUR RECUPERER EN HTML
// <input type="hidden" name="identifiantFormulaire" value="newletter-create">
// EN PHP
$identifiantFormulaire = filtrerInfo("identifiantFormulaire");
// TEST1: EST-CE QU'IL Y A UN FORMULAIRE A TRAITER?
if ($identifiantFormulaire != "") {
    // ON A UN FORMULAIRE A TRAITER
    // TEST2: LEQUEL???
    // JE METS EN PLACE UNE CONVENTION DE NOMMAGE SUR LE FICHIER DE TRAITEMENT
    // SI LE FICHIER EXISTE ALORS ON LE CHARGE POUR EFFECTUER LE TRAITEMENT
    
    $cheminFichier = "private/controller/traitement-$identifiantFormulaire.php";
    // https://www.php.net/manual/fr/function.is-file.php
    if (is_file($cheminFichier))
    {
        require_once $cheminFichier;
    }
    

    // SI ON VEUT DES SOUS-DOSSIERS POUR RANGER SES FICHIERS DE TRAITEMENT
    // UTILISER glob
    // AVEC UN CHEMIN COMME
    $cheminFichier = "private/controller/traitement-$identifiantFormulaire.php";
    // https://www.php.net/manual/fr/function.glob.php
    $tabFichierTraitement = glob($cheminFichier);
    foreach ($tabFichierTraitement as $fichierTraitement) {
        require_once $fichierTraitement;
    }
}
