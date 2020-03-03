<?php $headerTitle = "Hangar";
$classBody = "Hangar";
?>

<?php

require_once "private/controller/traitement.php";

// RETROUVER LE $level A PARTIR DE LA SESSION
$level = lireSession("level");
if ($level > 0) {
    // OK ACCES PERMIS*/
    require_once "private/view/hangar-view.php";
} else {
    // ACCES INTERDIT
    // REDIRIGER VERS LA PAGE login.php
    // https://www.php.net/manual/fr/function.header.php
    header("Location: login.php");

    // DEBUG
    echo "ACCES INTERDIT";
}
