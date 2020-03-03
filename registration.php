<?php require_once "private/controller/traitement.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    


<section>

    <div class="controlsAdmin">
        <a href="logout.php">Déconnexion</a>
        <a href="reservations.php">Retour au site</a>
    </div>

    <br>

    <div class="optin-container">
        <div class="ctd">Paramétrage des comptes admin</div>

        <div id="accueilCont" class="cadreDel form hiddenCadre">

            <!-- FORMULAIRE DE CREATION D'UNE LIGNE DANS LA TABLE SQL newsletter -->
            <form class="formLogin" action="" method="POST">
                <br>
                <h4>CRÉÉR UN NOUVEL ADMIN</h4>
                <!-- POUR LE VISITEUR -->
                <input class="form-control" type="text" name="login" required placeholder="LOGIN" maxlength="100">
                <br><br>
                <input class="form-control" type="email" name="email" required placeholder="EMAIL" maxlength="100">
                <br><br>
                <!-- ATTRIBUT pattern PERMET DE FORCER UN FORMAT PRECIS DANS UNE BALISE INPUT -->
                <input class="form-control" type="password" name="password" required placeholder="PASSWORD" maxlength="100" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" title="IL FAUT AU MOINS UNE MAJUSCULE, une minuscule ET 1 CHIFFRE">
                <br><br>
                <input class="form-control" type="password" name="password2" required placeholder="CONFIRMEZ LE PASSWORD" maxlength="100">
                <div>(IL FAUT AU MOINS UNE MAJUSCULE, une minuscule ET 1 CHIFFRE)</div>
                <br>
                <button type="submit" class="btnConnect">CRÉÉR COMPTE ADMIN</button>
                <!-- PARTIE TECHNIQUE -->
                <input type="hidden" name="identifiantFormulaire" value="user-create">
                <div class="feedback">
                    <?php echo $userFeedback ?? "" ?>
                </div>
            </form>

            <script>
                // https://plainjs.com/javascript/events/running-code-when-the-document-is-ready-15/
                // ATTENDRE QUE LE DOM HTML SOIT PRET
                document.addEventListener('DOMContentLoaded', function() {

                    //ON ATTEND QUE LE FORMULAIRE SOIT ENVOYE POUR ACTIVER NOTRE CODE
                    var formLogin = document.querySelector(".formLogin");
                    formLogin.addEventListener("submit", function(event) {
                        var password1 = document.querySelector("input[name=password]").value;
                        var password2 = document.querySelector("input[name=password2]").value;
                        console.log(password1);
                        console.log(password2);
                        if (password1 != password2) {
                            // DEBUG: BLOQUER L'ENVOI DU FORMULAIRE
                            event.preventDefault();
                            alert('VERIFIEZ LES 2 MOTS DE PASSE');
                        }
                    });

                });
            </script>

</body>
</html>