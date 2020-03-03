$(document).ready(function () {

    var time = "";
    var timeTrois = "";
    var mailOk = "";
    var passwordOk = "";
    var timeSound = "";

    $('.btn').click(function () {

        $("#player")[0].play();

        time = Math.round(new Date() / 1000) + 5;
        console.log("time: ", time);

        dateCreate();
        dateSoundCreate();

        $("#scanContainer").removeClass("hidden");
        $(".sectionHeader").addClass("hidden");

        // VERIFICATION DU CHAMP EMAIL
        verifMail();

        // VERIFICATION DU CHAMP PASSWORD
        verifPassword();

        return time;

    });

    function verifMail() {

        var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;

        if ((!regex.test($("#email").val()))) {

            $('#mailFalse').removeClass('hidden');
            mailOk = false;
        } else {
            $('#mailTrue').removeClass('hidden');
            mailOk = true;
        }
        return mailOk;
    };

    function verifPassword() {

        if ($('#password') !== "") {

            $('#passwordTrue').removeClass('hidden');
            passwordOk = true;
        } else {
            $('#passwordFalse').removeClass('hidden');
            passwordOk = false;
        };

        if ((passwordOk == true) && (mailOk == true)) {

            $("#print").addClass("greenPrint");

        } else {

            $("#print").addClass("redPrint");
        }

        return passwordOk;
    };

    function dateCreate() {

        timeTrois = Math.round(new Date() / 1000) + 7;

        return timeTrois;
    }

    function dateSoundCreate() {

        timeSound = Math.round(new Date() / 1000) + 3;
        console.log("timeSound: ", timeSound);

        return timeSound;
    }

    function boucleTiming() {

        var timeBis = "";

        if (time != "") {

            timeBis = Math.round(new Date() / 1000);

            if (time == timeBis) {

                $("#loading").addClass("hidden");
                $("#scanText").addClass("hidden");

                if ((passwordOk == true) && (mailOk == true)) {

                    $("#grantedAccess").removeClass("hidden");
                    $("#print").css("background-image", 'url("./assets/img/CircleHub/printGreen.png")');

                } else {

                    $("#deniedAccess").removeClass("hidden");
                    $("#print").css("background-image", 'url("./assets/img/CircleHub/printRed.png")');
                }

            };


            if (time != "") {
                if (timeBis == timeSound) {

                    $("#player")[0].play();

                } else {};
            } else {};

            if (timeBis == timeTrois) {

                if ((passwordOk == true) && (mailOk == true)) {

                    $("#submit").trigger("click");

                } else {

                    $("#scanContainer").addClass("hidden");
                    $(".sectionHeader").removeClass("hidden");

                }
            };

        } else {

        };

        setTimeout(boucleTiming, 1000); /* rappel après 1 secondes = 1000 millisecondes */

    };

    boucleTiming();

})