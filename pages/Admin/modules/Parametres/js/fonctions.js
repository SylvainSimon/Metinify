function saveAllParametre(avecRetour) {

    var arrayParametre = new Object();
    var stopValidation = false;

    cleanErrorInput();

    $("input, select, textarea").each(function () {

        if ($(this).prop("id").substring(0, 9) === "paramSite") {

            var idParam = $(this).prop("id").substring(10);
            var valueParam = $(this).prop("value");

            if ($(this).hasClass("inputIsSwitch")) {

                if ($(this).is(':checked')) {
                    valueParam = true;
                } else {
                    valueParam = false;
                }
            }

            arrayParametre[idParam] = valueParam;
        }
    });

    if (stopValidation == false) {
        Tableau_Json = JSON.stringify(arrayParametre);

        $.ajax({
            type: "POST",
            url: "./system/modules/medtra_parametres/ajax/ajaxEnregistrementParametres.php",
            data: "json=" + Tableau_Json,
            success: function (message) {

                if (avecRetour === true) {
                    Ajax('pages/Admin/modules/Parametres/Parametres.php')
                }
            }
        });
    }

}