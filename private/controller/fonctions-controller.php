<?php

// JE VAIS CREER LA FONCTION filterInfo
// SI EN HTML 
// <input name="nom">
// <input name="email">
// EN PHP
// $nom   = filtrerInfo("nom");
// $email = filtrerInfo("email");
function filtrerInfo($name, $valeurDefault = "")
{
    // ON DOIT SE PROTEGER DES ATTAQUES DES HACKERS
    // PROTECTION1: SI L'INFO N'EST PAS PRESENTE, JE METS LA VALEUR ""
    $valeur = $_REQUEST[$name] ?? $valeurDefault;
    // PROTECTION2: ENLEVER LES BALISES HTML ET PHP
    // https://www.php.net/manual/fr/function.strip-tags.php
    $valeur = strip_tags($valeur);
    // PROTECTION3: ENLEVER LES ESPACES INUTILES AU DEBUT ET A LA FIN
    // https://www.php.net/manual/fr/function.trim.php
    $valeur = trim($valeur);

    // RENVOIE LA VALEUR FILTREE
    return $valeur;
}

function filtrerEmail($name)
{
    //ON PASSE PAR LA FONCTION filtrerInfo POUR RECUPERER LE TEXTE
    $text = filtrerInfo($name);
    // ON AJOUTE UN FILTRE SUPPLEMENTAIRE
    // https://www.php.net/manual/fr/function.filter-var.php
    $emailFiltre = filter_var($text, FILTER_VALIDATE_EMAIL);

    return $emailFiltre;
}


function filtrerEntier($name, $valeurDefault = "")
{
    //ON PASSE PAR LA FONCTION filtrerInfo POUR RECUPERER LE TEXTE
    $text = filtrerInfo($name, $valeurDefault);
    // ON AJOUTE UN FILTRE SUPPLEMENTAIRE
    // POUR CONVERTIR EN NOMBRE
    // https://www.php.net/manual/fr/function.intval.php
    $nombre = intval($text);

    return $nombre;
}

function filtrerUpload($nameInput)
{
    $cheminImage = "";

    // VERIFIER SI IL Y A UN FICHIER UPLOADE
    // https://www.php.net/manual/fr/function.isset.php
    if (isset($_FILES[$nameInput])) {
        // JE RECUPERE LE TABLEAU ASSOCIATIF DES INFOS SUR L'UPLOAD
        $tabInfoUpload = $_FILES[$nameInput];
        // JE CREE DES VARIABLES A PARTIR DES CLES
        extract($tabInfoUpload);
        // $error, $size, $name, $type, $tmp_name
        if ($error == 0) {
            // OK LE FICHIER A ETE CORRECTEMENT TRANSFERE
            if ($size < 10 * 1024 * 1024)       // LIMITE A 10 Mo
            {
                // OK TAILLE RENTRE DANS LE QUOTA
                // ON VA EXTRAIRE DU NOM DU FICHIER SON EXTENSION
                // https://www.php.net/manual/fr/function.pathinfo.php
                $extension = pathinfo($name, PATHINFO_EXTENSION);
                // FILTRE: CONVERTIR EN MINUSCULE
                // https://www.php.net/manual/fr/function.strtolower.php
                $extension = strtolower($extension);
                $tabExtensionOK = ["jpg", "jpeg", "gif", "png", "txt"];  // A COMPLETER SUIVANT LES BESOINS
                // https://www.php.net/manual/fr/function.in-array.php
                if (in_array($extension, $tabExtensionOK)) {
                    // OK L'EXTENSION EST AUTORISEE
                    // NETTOYER LE NOM DU FICHIER
                    $filename = pathinfo($name, PATHINFO_FILENAME);
                    // REMPLACER LES CARACTERES NON lettres OU CHIFFRE PAR -
                    // https://www.php.net/manual/fr/function.preg-replace.php
                    $filename = preg_replace("/[^a-zA-Z0-9]/i", "-", $filename);
                    // FILTRER: CONVERTIR EN minuscules
                    $filename = strtolower($filename);

                    // JE PEUX DECIDER DE SORTIR LE FICHIER DE SA QUARANTAINE
                    // https://www.php.net/manual/fr/function.move-uploaded-file.php
                    // ATTENTION: IL FAUT AVOIR CREE LES DOSSIERS AVANT
                    // EN PHP mkdir
                    // https://www.php.net/manual/fr/function.mkdir.php
                    // REMPLIR LA VALEUR DE $cheminImage
                    $cheminImage = "assets/upload/$filename.$extension";
                    move_uploaded_file($tmp_name, $cheminImage);

                    // SI ON A UNE IMAGE ALORS ON VA CREER UNE MINIATURE
                    $tabExtensionImage = ["jpeg", "jpg", "gif", "png"];
                    if (in_array($extension, $tabExtensionImage)) {
                        $cheminMini = "assets/mini/$filename.$extension";

                        creerMini($cheminImage, $cheminMini, 300, 300);
                    }
                } else {
                    // KO EXTENSION INTERDITE
                }
            } else {
                // KO TAILLE DU FICHIER TROP GRAND
            }
        } else {
            // KO ERREUR LORS DE L'UPLOAD
        }
    }
    return $cheminImage;
}


function creerMini($cheminImageSrc, $cheminImageMini, $largeurMini, $hauteurMini)
{
    // CHARGER L'IMAGE A PARTIR DU FICHIER ORIGINE VERS LA MEMOIRE PHP
    $extension = pathinfo($cheminImageSrc, PATHINFO_EXTENSION);
    // FILTRE: CONVERTIR EN MINUSCULE
    // https://www.php.net/manual/fr/function.strtolower.php
    $extension = strtolower($extension);
    switch ($extension) {
        case "jpg":
        case "jpeg":
            // https://www.php.net/manual/fr/function.imagecreatefromjpeg.php
            $imageSource = imagecreatefromjpeg($cheminImageSrc);
            break;
        case "gif":
            // https://www.php.net/manual/fr/function.imagecreatefromgif.php
            $imageSource = imagecreatefromgif($cheminImageSrc);
            break;
        case "png":
            // https://www.php.net/manual/fr/function.imagecreatefrompng.php
            $imageSource = imagecreatefrompng($cheminImageSrc);
            break;
        default:
            $imageSource = null;
            break;
    }

    // ON COMMENCE AVEC SEULEMENT jpg
    if ($imageSource) {
        // LARGEUR ET HAUTEUR ORIGINE
        // https://www.php.net/manual/fr/function.imagesx.php
        // https://www.php.net/manual/fr/function.imagesy.php
        $largeurSource = imagesx($imageSource);
        $hauteurSource = imagesy($imageSource);

        // POUR EVITER LA DIVISION PAR ZERO
        if (($largeurSource > 0) && ($hauteurSource > 0)) {
            // ON PEUT CALCULER LA LARGEUR ET LA HAUTEUR MINIATURE
            // ON VA GARDER LE RATIO DE L'IMAGE SOURCE
            // ET ON VA AJUSTER L'IMAGE MINIATURE AU CARRE DEMANDE EN PARAMETRE
            if ($largeurSource > $hauteurSource) {
                // PAYSAGE
                $hauteurCible = $hauteurMini;
                $largeurCible = $largeurSource * $hauteurMini / $hauteurSource;
            } else {
                // PORTRAIT (OU CARRE)
                $largeurCible = $largeurMini;
                $hauteurCible = $hauteurSource * $largeurMini / $largeurSource;
            }

            // JE PEUX CREER L'IMAGE MINIATURE DANS LA MEMOIRE PHP
            // https://www.php.net/manual/fr/function.imagecreatetruecolor.php
            $imageCible = imagecreatetruecolor($largeurCible, $hauteurCible);

            // ATTENTION: IL FAUT AJOUTER CES PARAMETRES POUR GARDER LA TRANSPARENCE
            // SUR LES IMAGES GIF ET PNG
            // https://www.php.net/manual/fr/function.imagealphablending.php
            imagealphablending($imageCible, false);
            // https://www.php.net/manual/fr/function.imagesavealpha.php
            imagesavealpha($imageCible, true);

            // COPIER L'IMAGE SOURCE DANS L'IMAGE CIBLE
            // https://www.php.net/manual/fr/function.imagecopyresampled.php
            imagecopyresampled(
                $imageCible,
                $imageSource,
                0,
                0,                       // REMPLIT TOUTE LA MINIATURE
                0,
                0,                       // COPIE TOUTE L'IMAGE
                $largeurCible,
                $hauteurCible,
                $largeurSource,
                $hauteurSource,
            );

            // SAUVEGARDER L'IMAGE DANS UN FICHIER
            // ATTENTION: IL FAUT AVOIR CREE LE DOSSIER AVANT
            // https://www.php.net/manual/fr/function.imagejpeg.php
            // https://www.php.net/manual/fr/function.imagegif.php
            // https://www.php.net/manual/fr/function.imagepng.php
            switch ($extension) {
                case "jpg":
                case "jpeg":
                    imagejpeg($imageCible, $cheminImageMini);
                    break;
                case "gif":
                    imagegif($imageCible, $cheminImageMini);
                    break;
                case "png":
                    imagepng($imageCible, $cheminImageMini);
                    break;
                default:
                    break;
            }
        }
    }
}
