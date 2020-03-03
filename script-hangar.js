$(document).ready(function () {

    // Tableau d'objets des vaisseaux
    var tableauVaisseaux = [];

    // Objet chasseur
    var chasseur = {};
    chasseur.name = "CHASSEUR";
    chasseur.pv = 3000;
    chasseur.armure = 1000;
    chasseur.shield = 300;
    chasseur.vitesse = 10;
    chasseur.conso = 5;
    chasseur.costMetal = 3000;
    chasseur.costCristal = 1500;
    chasseur.costDeuterium = 0;
    chasseur.picture = "";

    // Objet destroyer
    var destroyer = {};
    destroyer.name = "DESTROYER";
    destroyer.pv = 10000;
    destroyer.armure = 5000;
    destroyer.shield = 2000;
    destroyer.vitesse = 5;
    destroyer.conso = 5;
    destroyer.costMetal = 10000;
    destroyer.costCristal = 5000;
    destroyer.costDeuterium = 500;
    destroyer.picture = "";

    // Objet cuirassé
    var cuirasse = {};
    cuirasse.name = "CUIRASSE";
    cuirasse.pv = 100000;
    cuirasse.armure = 50000;
    cuirasse.shield = 20000;
    cuirasse.vitesse = 1;
    cuirasse.conso = 50;
    cuirasse.costMetal = 750000;
    cuirasse.costCristal = 750000;
    cuirasse.costDeuterium = 500000;
    cuirasse.picture = "";

    // Objet fregate
    var fregate = {};
    fregate.name = "FREGATE";
    fregate.pv = 50000;
    fregate.armure = 25000;
    fregate.shield = 10000;
    fregate.vitesse = 2;
    fregate.conso = 25;
    fregate.costMetal = 400000;
    fregate.costCristal = 300000;
    fregate.costDeuterium = 50000;
    fregate.picture = "";

    // Objet fregate
    var micka = {};
    micka.name = "MICKA";
    micka.pv = 50000;
    micka.armure = 25000;
    micka.shield = 10000;
    micka.vitesse = 2;
    micka.conso = 25;
    micka.costMetal = 400000;
    micka.costCristal = 300000;
    micka.costDeuterium = 50000;
    micka.picture = "";

    // Tableau contenant tous les objets
    tableauVaisseaux.push(chasseur, destroyer, fregate, cuirasse, micka);

    // On génère le code HTML de chaque slide du carousel en bouclant sur le tableau d'objets
    function slideDetail() {

        // Sélecteur du carousel
        var selector = $(".carousel-inner");

        var htmlCode = "";

        for (i = 0; i < tableauVaisseaux.length; i++) {

            htmlCode =
                `<div class="carousel-item">  
                <div class="carousel-item-header dCenter">
                <h6>` + tableauVaisseaux[i].name + `</h6>
            </div>            
                    <div class="carousel-item-model dCenter">
                        <div class="skin ` + tableauVaisseaux[i].name + `"></div>
                    </div>                   
                    <div class="carousel-item-dev dCenter" data-parentId="` + i + `">
                        <div class="slidecontainer" data-id="` + i + `">
                            <input type="range" min="1" max="100" value="50" class="slider" id="myRange` + i + `">
                                <p id="demo` + i + `" class="demo"></p>
                        </div>
                        <div class="costHangarContainer">
                            <div class="metalCost" data-metalCost="` + tableauVaisseaux[i].costMetal + `">
                                <div class="mineraiPics"></div>
                                <p data-metal="true">` + (tableauVaisseaux[i].costMetal * 50) / 1000 + `K</p>
                            </div>
                            <div class="cristalCost" data-cristalCost="` + tableauVaisseaux[i].costCristal + `">
                                <div class="cristalPics"></div>
                                <p>` + (tableauVaisseaux[i].costCristal * 50) / 1000 + `K</p>
                            </div>
                            <div class="deuteriumCost" data-deuteriumCost="` + tableauVaisseaux[i].costDeuterium + `">
                                <div class="deuteriumPics"></div>
                                <p>` + (tableauVaisseaux[i].costDeuterium * 50) / 1000 + `K</p>
                            </div>
                        </div>
                        <div class="btn btnVaisseau" data-nbBtn="` + i + `">Fabriquer</div>
                    </div>
                </div>`;

            $(selector).append(htmlCode);

        }

    }

    slideDetail();

    // On ajoute la classe "active" sur le premier slide afin d'initialiser le carousel
    var carouselItem = $(".carousel-item");

    $(carouselItem[0]).addClass("active");

    // Affichage valeur range barre
    var myRange = $(".slider");
    var opt = $(".demo");

    for (i = 0; i < tableauVaisseaux.length; i++) {

        var valueInput = $(myRange[i]).val();
        $(opt[i]).text(valueInput);

        // Maj valeurs range barre
        $('.slider').on("change mousemove", function () {
            $(this).next().html($(this).val());

            var inputVal = $(this).val();

            var dataMetal = $(this).parent().next().children(".metalCost").attr("data-metalCost");
            var dataCristal = $(this).parent().next().children(".cristalCost").attr("data-cristalCost");
            var dataDeuterium = $(this).parent().next().children(".deuteriumCost").attr("data-deuteriumCost");

            var metalCost = $(this).parent().next().children(".metalCost").children("p");
            $(metalCost).text(((dataMetal * inputVal) / 1000) + "K");

            var cristalCost = $(this).parent().next().children(".cristalCost").children("p");
            $(cristalCost).text(((dataCristal * inputVal) / 1000) + "K");

            var deuteriumCost = $(this).parent().next().children(".deuteriumCost").children("p");
            $(deuteriumCost).text(((dataDeuterium * inputVal) / 1000) + "K");

        });
    }

    $(".btnVaisseau").click(function () {

        var nbBtn = $(this).attr("data-nbBtn");
        console.log("nbBtn: ", nbBtn);

        var demoSelector = $(".demo" + nbBtn);
        console.log(demoSelector);

    })

})