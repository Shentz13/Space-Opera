<?php


// LECTURE
function lireSession($cle)
{
    // https://www.php.net/manual/fr/function.isset.php
    if (!isset($_SESSION)) {
        session_start();    // CREE LE TABLEAU $_SESSION POUR NOUS
    }
    $valeur = $_SESSION[$cle] ?? "";    // ?? => PROTECTION SI NON CONNECTE
    return $valeur;
}

// ECRITURE
function ecrireSession($cle, $valeur)
{
    // https://www.php.net/manual/fr/function.isset.php
    if (!isset($_SESSION)) {
        session_start();    // CREE LE TABLEAU $_SESSION POUR NOUS
    }
    // ON STOCKE DANS LE TABLEAU ASSOCIATIF
    // (ET ENSUITE PHP VA GARDER LA CLE ET LA VALEUR A PART...)
    $_SESSION[$cle] = $valeur;
}


// ON A BESOIN DE CHERCHER UNE LIGNE DANS UNE TABLE SQL 
// SUIVANT LA VALEUR D'UNE COLONNE
function lireLigneSQL($nomTable, $valeurColonne, $nomColonne)
{
    // CONSTRUIRE UNE REQUETE PREPAREE
    $requetePrepareeSQL =
        <<<CODESQL

SELECT * 
FROM `$nomTable`
WHERE $nomColonne = :$nomColonne

CODESQL;

    // UN TOKEN DANS LA REQUETE PREPAREE
    $tabAssoColonneValeur = [$nomColonne => $valeurColonne];

    // ENVOYER LA REQUETE SQL
    // SECURITE: PROTECTION CONTRE LES INJECTIONS SQL
    // ON SEPARE LES INFOS EXTERIEURES DE LA REQUETE PREPAREE
    $objetPDOStatement = envoyerRequeteSQL($requetePrepareeSQL, $tabAssoColonneValeur);

    // POUR POUVOIR PARCOURIR AVEC LA BOUCLE foreach
    return $objetPDOStatement;
}


// ON A BESOIN D'UNE FONCTION QUI COMPTE LE NOMBRE DE LIGNES DANS UNE TABLE SQL
// LA FONCTION RENVERRA UN NOMBRE DIRECTEMENT
function compterLigneSQL($nomTable, $nomColonne = "", $valeurColonne = "")
{
    // IL SE PEUT QU'IL Y AIT UNE CLAUSE WHERE
    $clauseWhere = "";
    // PAS DE TOKEN DANS LA REQUETE PREPAREE
    $tabAssoColonneValeur = [];

    // SI ON A $nomColonne QUI N'EST PAS VIDE
    // ALORS ON AJOUTE UNE CLAUSE WHERE
    if ($nomColonne != "") {
        $clauseWhere = "WHERE $nomColonne = :$nomColonne";
        // UN TOKEN DANS LA REQUETE PREPAREE
        $tabAssoColonneValeur = [$nomColonne => $valeurColonne];
    }

    // CONSTRUIRE UNE REQUETE PREPAREE
    $requetePrepareeSQL =
        <<<CODESQL

SELECT count(*) as NbLigne
FROM `$nomTable`
$clauseWhere

CODESQL;


    // ENVOYER LA REQUETE SQL
    // SECURITE: PROTECTION CONTRE LES INJECTIONS SQL
    // ON SEPARE LES INFOS EXTERIEURES DE LA REQUETE PREPAREE
    $objetPDOStatement = envoyerRequeteSQL($requetePrepareeSQL, $tabAssoColonneValeur);

    // ON VA RECUPERER DIRECTEMENT LA VALEUR DE LA COLONNE
    // https://www.php.net/manual/fr/pdostatement.fetchcolumn.php
    $nbLigne = $objetPDOStatement->fetchColumn();

    return $nbLigne;
}


// ON A BESOIN D'UNE FONCTION POUR SUPPRIMER UNE LIGNE DANS UNE TABLE SQL
function supprimerLigneSQL($nomTable, $id)
{
    // CONSTRUIRE UNE REQUETE PREPAREE
    $requetePrepareeSQL =
        <<<CODESQL

DELETE FROM `$nomTable`
WHERE
id = :id

CODESQL;

    // UN TOKEN DANS LA REQUETE PREPAREE
    $tabAssoColonneValeur = ["id" => $id];

    // ENVOYER LA REQUETE SQL
    // SECURITE: PROTECTION CONTRE LES INJECTIONS SQL
    // ON SEPARE LES INFOS EXTERIEURES DE LA REQUETE PREPAREE
    $objetPDOStatement = envoyerRequeteSQL($requetePrepareeSQL, $tabAssoColonneValeur);

    // POUR POUVOIR PARCOURIR AVEC LA BOUCLE foreach
    return $objetPDOStatement;
}


// ON A BESOIN D'UNE FONCTION POUR LIRE LES LIGNES DANS UNE TABLE SQL
function lireTableSQL($nomTable, $colonneTri, $limit = 100, $offset = 0)
{
    // CONSTRUIRE UNE REQUETE PREPAREE
    $requetePrepareeSQL =
        <<<CODESQL

SELECT *
FROM `$nomTable`
ORDER BY $colonneTri DESC
LIMIT $limit
OFFSET $offset

CODESQL;

    // PAS DE TOKEN DANS LA REQUETE PREPAREE => TABLEAU VIDE
    $tabAssoColonneValeur = [];

    // ENVOYER LA REQUETE SQL
    // SECURITE: PROTECTION CONTRE LES INJECTIONS SQL
    // ON SEPARE LES INFOS EXTERIEURES DE LA REQUETE PREPAREE
    $objetPDOStatement = envoyerRequeteSQL($requetePrepareeSQL, $tabAssoColonneValeur);

    // POUR POUVOIR PARCOURIR AVEC LA BOUCLE foreach
    return $objetPDOStatement;
}

// ON A BESOIN D'UNE FONCTION POUR INSERER UNE LIGNE DANS UNE TABLE SQL
function insererLigneSQL($nomTable, $tabAssoColonneValeur)
{
    // CETTE FONCTION DOIT CREER LE CODE SQL 
    // POUR AJOUTER UNE LIGNE DANS UNE TABLE SQL
    // SECURITE: NE PAS UTILISER DES INFOS EXTERIEURES
    // UTILISER DES JETONS/TOKENS...
    $listeColonne = "";
    $listeToken   = "";
    // JE VAIS PARCOURIR LE TABLEAU ASSO $tabAssoColonneValeur
    // POUR RECUPERER LES CLES
    // JE TESTE SI ON EST AU DEBUT OU PAS
    $compteur = 0;
    foreach ($tabAssoColonneValeur as $colonne => $valeur) {
        if ($compteur != 0) {
            // AJOUTER UNE VIRGULE AVANT
            $listeColonne .= ", $colonne";
            $listeToken   .= ", :$colonne";
        } else {
            // NE PAS AJOUTER UNE VIRGULE
            $listeColonne .= "$colonne";
            $listeToken   .= ":$colonne";
        }

        // NE PAS OUBLIER D'INCREMENTER LE COMPTEUR
        $compteur++;
    }

    $requetePrepareeSQL =
        <<<CODESQL

INSERT INTO `$nomTable`
( $listeColonne )
VALUES
( $listeToken )

CODESQL;

    // ENVOYER LA REQUETE SQL
    // SECURITE: PROTECTION CONTRE LES INJECTIONS SQL
    // ON SEPARE LES INFOS EXTERIEURES DE LA REQUETE PREPAREE
    $objetPDOStatement = envoyerRequeteSQL($requetePrepareeSQL, $tabAssoColonneValeur);

    // RENVOYER $objetPDOStatement POUR AVOIR AUSSI lastInsertId
    return $objetPDOStatement;
}


function modifierLigneSQL($nomTable, $tabAssoColVal, $id)
{
    // CREER LA REQUETE SQL POUR LIRE DANS LA TABLE

    $listeColToken = "";
    foreach ($tabAssoColVal as $nomCol => $valeurCol) {
        $listeColToken .= "$nomCol = :$nomCol, ";
    }
    // ENLEVER LA VIRGULE EN TROP A LA FIN
    $listeColToken = trim($listeColToken, ", ");

    // POUR PASSER $id DIRECTEMENT DANS MA REQUETE PREPAREE
    // JE SECURISE EN LE CONVERTISSANT EN NOMBRE
    // https://www.php.net/manual/fr/function.intval.php
    $id = intval($id);

    $requetePrepareeSQL =
        <<<CODESQL

UPDATE $nomTable
SET
$listeColToken
WHERE
id_$nomTable = '$id';

CODESQL;


    // CONNECTER A MYSQL
    // ENVOYER LA REQUETE
    // RECUPERER LA LISTE DES LIGNES SELECTIONNEES
    $listeLigne = envoyerRequeteSQL($requetePrepareeSQL, $tabAssoColVal);

    // ON RENVOIE $listeLigne POUR POUVOIR FAIRE UNE BOUCLE 
    // ET AINSI AFFICHER LES INFOS 
    return $listeLigne;
}


function envoyerRequeteSQL($requetePrepareeSQL, $tabAssoColonneValeur)
{
    // ETAPE1: CONNECTER A LA DATABASE MYSQL
    // DSN
    $userSQL     = "root";
    $passwordSQL = "";
    $hostSQL     = "localhost";
    $databaseSQL = "";        // ATTENTION: A CHANGER A CHAQUE PROJET

    $tabParamProjet = lireParametreProjet();
    // ON VA ECRASER LES ANCIENNES VALEURS 
    // AVEC LES CLES/VALEURS DU TABLEAU ASSOCIATIF
    extract($tabParamProjet);

    $dsn = "mysql:localhost=$hostSQL;dbname=$databaseSQL;charset=utf8";

    // CREER UN OBJET PDO POUR GERER LA CONNEXION
    // https://www.php.net/manual/fr/pdo.construct.php
    $objetPDO = new PDO($dsn, $userSQL, $passwordSQL);

    // AFFICHER LES ERREURS SQL EN MODE ERREUR PHP
    $objetPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    // ETAPE2: PREPARER LA REQUETE SQL
    // https://www.php.net/manual/fr/pdo.prepare.php
    $objetPDOStatement = $objetPDO->prepare($requetePrepareeSQL);

    // ETAPE3: EXECUTE LA REQUETE AVEC LES VALEURS QUI REMPLACENT LES JETONS
    // https://www.php.net/manual/fr/pdostatement.execute.php
    $objetPDOStatement->execute($tabAssoColonneValeur);

    // BRICOLAGE POUR RECUPERER LE DERNIER id D'UNE NOUVELLE LIGNE 
    // (INSERT INTO...)
    // https://www.php.net/manual/fr/pdo.lastinsertid.php
    // SAUVAGE MAIS CA MARCHE...
    // JE RAJOUTE UN ATTRIBUT/PROPRIETE DANS L'OBJET $objetPDOStatement
    $objetPDOStatement->monLastInsertId = $objetPDO->lastInsertId();

    // A DECOMMENTER POUR DEBUGGER PLUS FACILEMENT
    // https://www.php.net/manual/fr/pdostatement.debugdumpparams.php
    // $objetPDOStatement->debugDumpParams();

    // OPTIMISATION POUR RECUPERER LES INFOS SOUS LA FORME D'UN TABLEAU ASSOCIATIF
    // https://www.php.net/manual/fr/pdostatement.setfetchmode.php
    $objetPDOStatement->setFetchMode(PDO::FETCH_ASSOC);

    // ON RENVOIE $objPDOStatement
    return $objetPDOStatement;
}
