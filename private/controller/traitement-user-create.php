<?php

// AJOUTER LE CODE POUR TRAITER LE FORMULAIRE user-create

// ETAPE1: RECUPERER ET FILTRER LES INFOS DU FORMULAIRE
// login
// email
// password

// ETAPE2: SECURITE (TRES IMPORTANT)
// VALIDER QUE LES INFOS SONT CORRECTES

// ETAPE3: COMPLETER LES INFOS MANQUANTES
// dateInscription
// level

// ETAPE4: STOCKER DANS LA TABLE SQL user


// ETAPE0: VERIFIER LE level DU VISITEUR
// RETROUVER LE $level A PARTIR DE LA SESSION
/*$level = lireSession("level");
if ($level > 0) {*/
    // ETAPE1:
    $login      = filtrerInfo("login");
    $email      = filtrerInfo("email");
    $password   = filtrerInfo("password");

    // ETAPE2: FETE DU IF
    // IL FAUDRAIT VERIFIER QUE LE TEXTE NE DEPASSE 160 CARACTERES
    // https://www.php.net/manual/fr/function.mb-strlen.php
    // VERIFIER LE FORMAT DE L'EMAIL
    // https://www.php.net/manual/fr/function.filter-var.php
    // IL FAUDRAIT AUSSI VERIFIER L'UNICITE DE L'EMAIL
    // POUR LE MOMENT, ON RESTE BASIQUE
    if (($login != "") && ($email != "") && ($password != "")) {
        // ON VA VERIFIER SI L'EMAIL EST DEJA UTILISE PAR UN UTILISATEUR DEJA CREE
        $nbEmailDuplicate = compterLigneSQL("user", "email", $email);
        $nbLoginDuplicate = compterLigneSQL("user", "login", $login);
        if (($nbEmailDuplicate == 0) && ($nbLoginDuplicate == 0)) {
            // ETAPE3: COMPLETER LES INFOS MANQUANTES
            // https://www.php.net/manual/fr/function.date.php
            $dateInscription = date("Y-m-d H:i:s");     // FORMAT DATETIME SQL
            $level           = 1;                       // USER ACTIF IMMEDIATEMENT

            // SECURITE: ON HASHE LE MOT DE PASSE
            // https://www.php.net/manual/fr/function.password-hash.php
            $passwordHash    = password_hash($password, PASSWORD_DEFAULT);


            // ETAPE4: STOCKER LES INFOS DANS LA TABLE SQL newsletter
            // JE VAIS APPELER LA FONCTION insererLigneSQL

            file_put_contents("private/model/traitement-user-create.csv", "$login,$email,$passwordHash,$level,$dateInscription\n", FILE_APPEND);

            insererLigneSQL("user", [
                "login"             => $login,
                "email"             => $email,
                "password"          => $passwordHash,       // ON STOCKE LE MOT DE PASSE HASHE
                "level"             => $level,
                "dateInscription"   => $dateInscription,
            ]);

            insererLigneSQL("minerai", ["stock" => "10", "stock_mine" => "0", "prod_min" => "3", "capacite_mine" => "4000", "capacite_max" => "20000", "niveau_mine" => "1", "temps_upgrade" => "10", "date_fin_upgrade" => $dateInscription, "date" => $dateInscription]);               
            insererLigneSQL("cristal", ["stock" => "10", "stock_mine" => "0", "prod_min" => "3", "capacite_mine" =>"4000", "capacite_max" => "20000", "niveau_mine" => "1", "temps_upgrade" => "10", "date_fin_upgrade" => $dateInscription, "date" => $dateInscription]);
            insererLigneSQL("deuterium", ["stock" => "5", "stock_mine" => "0", "prod_min" => "2", "capacite_mine" =>"4000", "capacite_max" => "16000", "niveau_mine" => "1", "temps_upgrade" => "12", "date_fin_upgrade" => $dateInscription, "date" => $dateInscription]);
            insererLigneSQL("poussiere", ["stock" => "3", "stock_mine" => "0", "prod_min" => "1.4", "capacite_mine" =>"3000", "capacite_max" => "12000", "niveau_mine" => "1", "temps_upgrade" => "15", "date_fin_upgrade" => $dateInscription, "date" => $dateInscription]);
            insererLigneSQL("matiere", ["stock" => "1", "stock_mine" => "0", "prod_min" => "1", "capacite_mine" =>"2000", "capacite_max" => "10000", "niveau_mine" => "1", "temps_upgrade" => "20", "date_fin_upgrade" => $dateInscription, "date" => $dateInscription]);

            // DONNER LE MESSAGE A AFFICHER EN FEEDBACK
            $userFeedback = "VOTRE USER EST CREE. MERCI $login. ($email)";
        } else {
            // DONNER LE MESSAGE A AFFICHER EN FEEDBACK
            $userFeedback = "DESOLE CET EMAIL OU LOGIN EST DEJA PRIS ($email)";
        }

} else {
    echo "INTERDIT";
}
