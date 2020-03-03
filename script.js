$(document).ready(function () {

    var rempCasesConv = "";

    // Fonction d'initialisation
    function initMines() {
        $(".mines").addClass("isDisabled");
        $(".mines").off("click");
    }

    initMines();

    for (i = 0; i < 20; i++) {

        var jaugeCase = `<div class="jaugeCase"></div>`

        $("#jauge").append(jaugeCase);

    }


    $("#buttonLeftMenu").click(function () {

        if ($("#leftMenu").hasClass("waitingInit")) {

            $("#leftMenu").addClass("leftMenuSlideIn").removeClass("waitingInit");
            $(".buttonLight").addClass("activeLight");

        } else if ($("#leftMenu").hasClass("leftMenuSlideOut")) {

            $("#leftMenu").addClass("leftMenuSlideIn").removeClass("leftMenuSlideOut");
            $(".buttonLight").addClass("activeLight");

        } else {

            $("#leftMenu").addClass("leftMenuSlideOut").removeClass("leftMenuSlideIn");
            $(".buttonLight").removeClass("activeLight");
        }


    });

    $("#profil").click(function () {

        $('#profilSection').removeClass("hidden");
    });

    $("#circlePointor, #circlePointor2").addClass("circlePointorAnimate");
    $("#middleWhiteCircle").addClass("whiteCircleAnimate");
    $("#outCircle").addClass("outCircleAnimate");
    $("#energy").addClass("fadeIn");

    $("#btnCloseProfil, #profilSection").click(function () {

        $('#profilSection').addClass("hidden");
    });

    function dateDiff(date1, date2) {
        var tmp = date2 - date1;

        tmp = Math.floor(tmp / 1000);
        tmp = Math.floor(tmp / 60);

        return tmp;
    }

    function heureDiff(date1, date2) {
        var tmp = date2 - date1;
        console.log(tmp);
        tmp = Math.floor(tmp / (1000 * 60 * 60));

        console.log(tmp);

        return tmp;
    }

    function sqlToJsDate(sqlDate) {

        //sqlDate in SQL DATETIME format ("yyyy-mm-dd hh:mm:ss.ms")
        var sqlDateArr1 = sqlDate.split("-");

        //format of sqlDateArr1[] = ['yyyy','mm','dd hh:mm:ms']
        var sYear = sqlDateArr1[0];
        var sMonth = (Number(sqlDateArr1[1]) - 1).toString();
        var sqlDateArr2 = sqlDateArr1[2].split(" ");

        //format of sqlDateArr2[] = ['dd', 'hh:mm:ss.ms']
        var sDay = sqlDateArr2[0];
        var sqlDateArr3 = sqlDateArr2[1].split(":");

        //format of sqlDateArr3[] = ['hh','mm','ss.ms']
        var sHour = sqlDateArr3[0];
        var sMinute = sqlDateArr3[1];
        var sqlDateArr4 = sqlDateArr3[2].split(".");

        //format of sqlDateArr4[] = ['ss','ms']
        var sSecond = sqlDateArr4[0];

        return new Date(sYear, sMonth, sDay, sHour, sMinute, sSecond);

    }

    var tableauRessources = [];

    var mineMinerai = {};
    mineMinerai.name = "Fonderie de minerai";
    mineMinerai.stockMine = parseInt($("#mineraiHidden").attr("data-stockMine")); // stock dans la mine
    mineMinerai.stockTotal = $("#mineraiHidden").attr("data-stockTotal"); // stock total
    mineMinerai.gainParMin = parseInt($("#mineraiHidden").attr("data-prod")); // production par minute
    mineMinerai.limiteStockMine = $("#mineraiHidden").attr("data-capaMine"); // stock max mine
    mineMinerai.limiteStockTotal = $("#mineraiHidden").attr("data-capaTotale"); // stock max total
    mineMinerai.selector = $("#mineraiCount p"); // compteur(affichage) de la ressource
    mineMinerai.mine = $("#mineMinerai"); // element HTML de la mine
    mineMinerai.hiddenInput = $("#mineraiHidden"); // input masqué contenant toutes les infos
    mineMinerai.lastRecup = $("#mineraiHidden").attr("data-date"); // date derniere récupération de la mine
    mineMinerai.hiddenMineInput = $("#stockMineMineraiHidden");
    mineMinerai.picture = "assets/img/minerai.jpg";
    mineMinerai.tempsUpgrade = $("#mineraiHidden").attr("data-tempsUpgrade");

    var mineCristal = {};
    mineCristal.name = "Mine de Cristal";
    mineCristal.stockMine = $("#cristalHidden").attr("data-stockMine");
    mineCristal.stockTotal = $("#cristalHidden").attr("data-stockTotal");
    mineCristal.gainParMin = $("#cristalHidden").attr("data-prod");
    mineCristal.limiteStockMine = $("#cristalHidden").attr("data-capaMine");
    mineCristal.limiteStockTotal = $("#cristalHidden").attr("data-capaTotale");
    mineCristal.selector = $("#cristalCount p");
    mineCristal.mine = $("#mineCristal");
    mineCristal.hiddenInput = $("#cristalHidden");
    mineCristal.lastRecup = $("#cristalHidden").attr("data-date");
    mineCristal.hiddenMineInput = $("#stockMineCristalHidden");
    mineCristal.picture = "assets/img/cristal.jpg";
    mineCristal.tempsUpgrade = $("#cristalHidden").attr("data-tempsUpgrade");

    var mineDeuterium = {};
    mineDeuterium.name = "Gisement de deutérium";
    mineDeuterium.stockMine = $("#deuteriumHidden").attr("data-stockMine");
    mineDeuterium.stockTotal = $("#deuteriumHidden").attr("data-stockTotal");
    mineDeuterium.gainParMin = $("#deuteriumHidden").attr("data-prod");
    mineDeuterium.limiteStockMine = $("#deuteriumHidden").attr("data-capaMine");
    mineDeuterium.limiteStockTotal = $("#deuteriumHidden").attr("data-capaTotale");
    mineDeuterium.selector = $("#deuteriumCount p");
    mineDeuterium.mine = $("#mineDeuterium");
    mineDeuterium.hiddenInput = $("#deuteriumHidden");
    mineDeuterium.lastRecup = $("#deuteriumHidden").attr("data-date");
    mineDeuterium.hiddenMineInput = $("#stockMineDeuteriumHidden");
    mineDeuterium.picture = "assets/img/deuterium.jpg";
    mineDeuterium.tempsUpgrade = $("#deuteriumHidden").attr("data-tempsUpgrade");

    var minePoussiere = {};
    minePoussiere.name = "Recycleur de poussière d'étoile";
    minePoussiere.stockMine = $("#poussiereHidden").attr("data-stockMine");
    minePoussiere.stockTotal = $("#poussiereHidden").attr("data-stockTotal");
    minePoussiere.gainParMin = $("#poussiereHidden").attr("data-prod");
    minePoussiere.limiteStockMine = $("#poussiereHidden").attr("data-capaMine");
    minePoussiere.limiteStockTotal = $("#poussiereHidden").attr("data-capaTotale");
    minePoussiere.selector = $("#poussiereCount p");
    minePoussiere.mine = $("#minePoussiereEtoile");
    minePoussiere.hiddenInput = $("#poussiereHidden");
    minePoussiere.lastRecup = $("#poussiereHidden").attr("data-date");
    minePoussiere.hiddenMineInput = $("#stockMinePoussiereHidden");
    minePoussiere.picture = "assets/img/poussiere.jpg";
    minePoussiere.tempsUpgrade = $("#poussiereHidden").attr("data-tempsUpgrade");

    var mineMatiere = {};
    mineMatiere.name = "Centrale de conversion de matière noire";
    mineMatiere.stockMine = $("#matiereHidden").attr("data-stockMine");
    mineMatiere.stockTotal = $("#matiereHidden").attr("data-stockTotal");
    mineMatiere.gainParMin = $("#matiereHidden").attr("data-prod");
    mineMatiere.limiteStockMine = $("#matiereHidden").attr("data-capaMine");
    mineMatiere.limiteStockTotal = $("#matiereHidden").attr("data-capaTotale");
    mineMatiere.selector = $("#matiereCount p");
    mineMatiere.mine = $("#mineMatiereNoire");
    mineMatiere.hiddenInput = $("#matiereHidden");
    mineMatiere.lastRecup = $("#matiereHidden").attr("data-date");
    mineMatiere.hiddenMineInput = $("#stockMineMatiereHidden");
    mineMatiere.picture = "assets/img/matiere.jpg";
    mineMatiere.tempsUpgrade = $("#matiereHidden").attr("data-tempsUpgrade");

    tableauRessources.push(mineMinerai, mineCristal, mineDeuterium, minePoussiere, mineMatiere);

    /* FONCTION POUR RAMASSER TOUTES LES MINES EN UNE FOIS

        function gainRessources(list, time) {

            for (var i = 0; i < list.length; i++) { // Boucle sur le nombre d'objets
                for (var ressources in list) { // Boucle sur chaque objet

                    var gain = (list[ressources].gainParMin) * time;

                    if ((list[ressources].stock + gain) < list[ressources].limiteStock) {

                        list[ressources].stock += gain;

                    } else {

                        list[ressources].stock += list[ressources].limiteStock;

                    }
                    list[ressources].selector.text(list[ressources].stock);
                }

                return list[ressources].stock;

            }

        }
*/
    function gainRessources(objet, time) {

        objet.stockTotal = parseInt(objet.stockTotal);
        objet.stockMine = parseInt(objet.stockMine);
        objet.limiteStockMine = parseInt(objet.limiteStockMine);
        objet.limiteStockTotal = parseInt(objet.limiteStockTotal);
        objet.gainParMin = parseInt(objet.gainParMin);

        // On ajoute au stock de la mine son gain/min * temps écoulé
        objet.stockMine += (objet.gainParMin * time);

        // Si stock mine inférieur à son max
        // et inférieur à la capacité libre du stock total
        if (objet.stockMine < objet.limiteStockMine) {
            if (objet.stockMine < (objet.limiteStockTotal - objet.stockTotal)) {

                // On ajoute au stock total le stock de la mine
                // et on remet le stock de la mine à 0
                objet.stockTotal += objet.stockMine;
                objet.stockMine = 0;

            } else {

                // Sinon si capacité stock total insuffisant                            
                // On enregistre la différence dans une variable
                var stockTotalTemporary = (objet.limiteStockTotal - objet.stockTotal);
                // On remplit le stock total
                objet.stockTotal += (objet.limiteStockTotal - objet.stockTotal);
                // et on déduit du stock mine ce qui a été récolté
                objet.stockMine -= stockTotalTemporary;

            }
        } else { // Sinon si stock mine supérieur au stockage max de la mine

            // et stock max(puisque le stock mine est tronqué) inférieur à la capacité de stockage total disponible
            if (objet.limiteStockMine < (objet.limiteStockTotal - objet.stockTotal)) {

                // On ajoute au stock total le stock max de la mine
                objet.stockTotal += objet.limiteStockMine; // ou ((objet.limiteStock / objet.gainParMin) * objet.gainParMin);
                // et on remet le stock mine à 0
                objet.stockMine = 0;

            } else { // Sinon si stock max de la mine supérieur à la capacité totale disponible

                // On enregistre la différence dans une variable
                stockTotalTemporary = (objet.limiteStockTotal - objet.stockTotal);
                // On ajoute la différence
                objet.stockTotal += (objet.limiteStockTotal - objet.stockTotal) // ou (((objet.limiteStockMine / objet.gainParMin) * objet.gainParMin) - objet.stockTotal);
                // et on déduit du stock mine ce qui a été récolté
                objet.stockMine -= stockTotalTemporary;

                // Si stock mine toujours supérieur à la capacité de la mine, stock mine = capacité max
                if (objet.stockMine > objet.limiteStockMine) {
                    objet.stockMine = objet.limiteStockMine;
                } else {

                }

            }

        }

        $(objet.hiddenInput).val(objet.stockTotal);
        $(objet.hiddenMineInput).val(objet.stockMine);

        return objet.stockMine;

    }

    $(".mines").hover(
        function () {

            $("#player")[0].play();
        }
    );

    var diff = "";

    $(".mines").click(function () {

        var type = "";
        var lastRecuperation = "";

        if ($(this).is("#mineMinerai")) {

            type = mineMinerai;
            lastRecuperation = mineMinerai.lastRecup;

        } else if ($(this).is("#mineCristal")) {

            type = mineCristal;
            lastRecuperation = mineCristal.lastRecup;

        } else if ($(this).is("#mineDeuterium")) {

            type = mineDeuterium;
            lastRecuperation = mineDeuterium.lastRecup;

        } else if ($(this).is("#minePoussiereEtoile")) {

            type = minePoussiere;
            lastRecuperation = minePoussiere.lastRecup;

        } else {

            type = mineMatiere;
            lastRecuperation = mineMatiere.lastRecup;
        }

        var thisRecup = new Date();

        diff = dateDiff(sqlToJsDate(lastRecuperation), thisRecup);
        console.log("diff: ", diff);

        gainRessources(type, diff);

        $("#submitRessources").trigger("click");
        $(this).prop('disabled', true);

    })

    /*
        function afficherMines(list, time) {

            for (var i = 0; i < list.length; i++) { // Boucle sur le nombre d'objets
                for (var ressources in list) { // Boucle sur chaque objet

                    if (time >= 1) {
                        var mineSelector = (list[ressources].mine);
                        $(mineSelector).removeClass("hidden");
                    } else {

                    }

                }

            }

        }

        var test = setTimeout(afficherMines(tableauRessources, diff), 2000);

    */

    var typeBat = "";

    $(".upBatiment").click(function (event) {

        event.stopPropagation();

        var parentName = $(this).parents("div").attr("id");

        var modal = "";

        var v = "";

        $("#batimentTitle").removeClass();

        $("#batimentTitle").addClass(parentName);

        if (parentName == "mineMinerai") {

            type = mineMinerai;
            modal = $("#mineraiBat");
            v = 0; // index pour parcourir l'input avec les attributs data

        } else if (parentName == "mineCristal") {

            type = mineCristal;
            modal = $("#cristalBat");
            v = 1; // index pour parcourir l'input avec les attributs data

        } else if (parentName == "mineDeuterium") {

            type = mineDeuterium;
            modal = $("#deuteriumBat");
            v = 2; // index pour parcourir l'input avec les attributs data

        } else if (parentName == "minePoussiereEtoile") {

            type = minePoussiere;
            modal = $("#poussiereBat");
            v = 3; // index pour parcourir l'input avec les attributs data

        } else {

            type = mineMatiere;
            modal = $("#matiereBat");
            v = 4; // index pour parcourir l'input avec les attributs data

        }

        typeBat = type;

        $("#batimentTitle h2").text(type.name);

        $(modal).removeClass("hidden");

        $("#batimentPicture").css({
            "background-image": "URL(" + type.picture + ")",
            "background-size": "cover",
            "background-position": "center"
        });

        var jSelector = $("#formData input");

        var jr = $(jSelector[v]).attr("data-stockMine");
        var jc = $(jSelector[v]).attr("data-capaMine");

        // Calcul du %age de remplissage
        var jRemp = ((100 * jr) / jc);

        var rempCases = jRemp / 5;

        rempCasesConv = rempCases.toFixed(0);

        var tabCasesJauge = $(".jaugeCase");

        for (i = 0; i < rempCasesConv; i++) {

            $(tabCasesJauge[i]).addClass("jaugeCaseFull");

        }

        $("#batimentSection").removeClass("hidden");

        $("#btnCloseBatiment, #batimentSection").click(function () {

            $('#batimentSection').addClass("hidden");
            $(modal).addClass("hidden");
            $(tabCasesJauge).removeClass("jaugeCaseFull");
        })

        return typeBat;

    });

    var parentTest = "";

    $("#btnUpBatiment").click(function () {

        parentTest = "";
        /*
                type = typeBat;

                var upCost = type.limiteStockMine / 5;

                var upgradeTime = type.tempsUpgrade * 2;

                var newStockage = parseInt(type.limiteStockMine) + (type.limiteStockMine / 3);

                var upProd = type.gainParMin + (type.gainParMin / 4);

                var dateDebutUp = new Date();

                var minutes = dateDebutUp.getMinutes();
                var dateFin = dateDebutUp.setMinutes(minutes + upgradeTime);
                var dateFinUp = new Date(dateFin);
        */
        parentTest = $(this).parent().parent().parent().parent().children().attr("class");

        var inputBatSelector = $("#upgradeOfBatiment");

        $(inputBatSelector).val(null);

        $(inputBatSelector).val(parentTest);

        $(typeBat.mine).addClass("isDisabled");
        $(typeBat.mine).off("click");

        $("#submitBatiment").trigger("click");

    });

    function boucleTiming() {

        var dateBoucleTest = new Date();

        var dateSQL = $(".dateMark");

        var mineDisabled = $(".mines");

        for (i = 0; i < dateSQL.length; i++) {

            var dateATester = $(dateSQL[i]).attr("data-dateMark");

            var remplissage = $(mineDisabled[i]).children(".remplissage");

            var rSelector = $("#formData input");

            var mSpan = $(".percent");

            var rCount = $(".ressourcesCounter");

            var inputStock = $(".dataInput").attr("data-stockTotal");

            var inputCapa = $(".dataInput").attr("data-capaTotale");

            // Si le stock total est au maximum de la capacité de stockage
            if (inputStock[i] == inputCapa[i]) {

                // On affiche le total en rouge
                $(rCount[i]).css("color", "red");

            } else {

                // Sinon on l'affiche en blanc
                $(rCount[i]).css("color", "white");
            }

            // On ajoute un effet visuel du niveau de remplissage des mines en fonction du
            // %age de remplissage par rapport à la capacité max 
            var r = $(rSelector[i]).attr("data-stockMine");
            var c = $(rSelector[i]).attr("data-capaMine");

            // Calcul du %age de remplissage
            var pRemp = ((100 * r) / c);

            // On augmente "la jauge" de remplissage
            //$(remplissage).css("height", pRemp + '%');

            // On ajoute le %age de remplissage à l'infobulle des mines
            $(mSpan[i]).text(" " + pRemp.toFixed(0) + '%');

            /*
                        // On modifie la couleur de l'effet de remplissage en fonction du niveau de stock dans la mine
                        if (pRemp < 50) {

                            // vert si stock mine inférieur à 50%
                            $(remplissage).css("background-color", "rgba(6, 214, 23, 0.3)");

                        } else if ((pRemp >= 50) && (pRemp <= 70)) {

                            // Jaune si compris entre 50% et 70%
                            $(remplissage).css("background-color", "rgba(201, 204, 0, 0.55)");

                        } else if ((pRemp > 70) && (pRemp <= 99)) {

                            // Orange si compris entre 71% et 99%
                            $(remplissage).css("background-color", "rgba(238, 97, 15, 0.5)");

                        } else {

                            // Rouge si 100%
                            $(remplissage).css("background-color", "rgba(238, 15, 15, 0.3)");
                        }*/

            // Test si date SQL non correctement initialisée à la création du compte (cas en devMod)
            if (dateATester != "0000-00-00") {

                // On compare la date actuelle à la date de fin du bâtiment
                var testDiff = dateDiff(sqlToJsDate(dateATester), dateBoucleTest);

                // Si date actuelle sup à la date de fin de construction
                if (testDiff > 0) {

                    // On rend le bâtiment utilisable à nouveau
                    $(mineDisabled[i]).removeClass("isDisabled");
                    $(mineDisabled[i]).on("click");

                } else {

                }

            } else {

            }
        }

        setTimeout(boucleTiming, 2000); /* rappel après 2 secondes = 2000 millisecondes */

    }

    boucleTiming();

    function createJauge(elem) {
        if (elem) {
            // on commence par un clear
            while (elem.firstChild) {
                elem.removeChild(elem.firstChild);
            }
            // création des éléments
            var oMask = document.createElement('DIV');
            var oBarre = document.createElement('DIV');
            var oSup50 = document.createElement('DIV');
            // affectation des classes
            oMask.className = 'progress-masque';
            oBarre.className = 'progress-barre';
            oSup50.className = 'progress-sup50';
            // construction de l'arbre
            oMask.appendChild(oBarre);
            oMask.appendChild(oSup50);
            elem.appendChild(oMask);
        }
        return elem;
    }

    function initJauge(elem) {
        var oBarre;
        var angle;
        var valeur;
        //
        createJauge(elem);
        oBarre = elem.querySelector('.progress-barre');
        valeur = elem.getAttribute('data-value');
        valeur = valeur ? valeur * 1 : 0;
        elem.setAttribute('data-value', valeur.toFixed(1));
        angle = 360 * valeur / 100;
        if (oBarre) {
            oBarre.style.transform = 'rotate(' + angle + 'deg)';
        }
    }

    var oJauges = document.querySelectorAll('.progress-circle');
    var i, nb = oJauges.length;
    for (i = 0; i < nb; i += 1) {
        initJauge(oJauges[i]);
    }


})