<?php

// AJOUTER LE CODE POUR TRAITER LE FORMULAIRE user-login

// ETAPE1: RECUPERER ET FILTRER LES INFOS DU FORMULAIRE
// email
// password

// ETAPE2: SECURITE (TRES IMPORTANT)
// VALIDER QUE LES INFOS SONT CORRECTES

// ETAPE3: COMPLETER LES INFOS MANQUANTES

// ETAPE4: VERIFIER LES INFOS FOURNIES AVEC LA LIGNE DANS LA TABLE user

// ETAPE1:
$email     = filtrerInfo("email");
// ON CHANGE DE NOM POUR LA VARIABLE PHP
// POUR NE PAS PERDRE LA VALEUR AVEC LE extract DE LA LIGNE SQL
$passwordNoHash   = filtrerInfo("passwordNoHash");

// ETAPE2: FETE DU IF
// IL FAUDRAIT VERIFIER QUE LE TEXTE NE DEPASSE 160 CARACTERES
// https://www.php.net/manual/fr/function.mb-strlen.php
// VERIFIER LE FORMAT DE L'EMAIL
// https://www.php.net/manual/fr/function.filter-var.php
// IL FAUDRAIT AUSSI VERIFIER L'UNICITE DE L'EMAIL
// POUR LE MOMENT, ON RESTE BASIQUE
if (($email != "") && ($passwordNoHash != "")) {
    // ON VA VERIFIER SI L'EMAIL EST DEJA UTILISE PAR UN UTILISATEUR DEJA CREE
    // IL FAUT CHERCHER SI UNE LIGNE EXISTE AVEC CET EMAIL
    // ET RECUPERER TOUTES LES COLONNES DE CETTE LIGNE
    // => passwordHashe
    // => level

    // ON NE DEVRAIT EN TROUVER QUE 0 OU 1 LIGNE
    // (PAS DE DOUBLON...)
    $listeLigne = lireLigneSQL("user", $email, "email");
    // LECTURE DES RESULTATS
    foreach ($listeLigne as $tabLigne) {

        // ON A TROUVE UNE LIGNE QUI CORRESPOND A L'EMAIL
        // IL ME FAUT VERIFIER LE PASSWORD ET AUSSI LE LEVEL
        extract($tabLigne);
        // => CREE LES VARIABLES A PARTIR DES COLONNES
        // => CREE LES VARIABLES $password ET $level
        // $passwordNoHash  = "Abc123";
        // $password        = "$2y$10$vhWrMvzqRmJjMN57Wt6xCeLya1f4WpzYbwa3TlOr6VW...";
        // if ($passwordNoHash == $password) CA NE MARCHE PAS
        // https://www.php.net/manual/fr/function.password-verify.php
        if (password_verify($passwordNoHash, $password)) {
            // OK LES MOTS DE PASSE CORRESPONDENT
            if ($level > 0) {
                // OK LE COMPTE EST ACTIF
                $loginFeedback = "BIENVENUE $login";

                // ON VA MEMORISER DANS UNE SESSION LES INFOS DE L'UTILISATEUR
                ecrireSession("level", $level);
                ecrireSession("login", $login);
                ecrireSession("email", $email);
                ecrireSession("id_user", $id_user);


                // REDIRIGER VERS LA PAGE admin-user.php
                // https://www.php.net/manual/fr/function.header.php
                header("Location: accueil.php");
            } else {
                // KO LE COMPTE EST DESACTIVE
                $loginFeedback = "VA T'EN GROS TROLL $login";
            }
        } else {
            // KO LES MOTS DE PASSE NE CORRESPONDENT PAS
            $loginFeedback = "LE MOT DE PASSE EST INVALIDE";
        }
    }

    // CAS ERREUR MAUVAIS MAIL
    // https://www.php.net/manual/fr/function.empty.php
    if (empty($tabLigne)) {
        // MAUVAIS EMAIL    
        $loginFeedback = "EMAIL INVALIDE";
    }
}

?>