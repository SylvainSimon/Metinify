function Ajax_Appel_Statistiques(page, objet) {

    displayLoading();

    $('#Contenue_Comptes').html("<i class='material-icons md-icon-spin fa fa-spin' ></i>");
    $('#Contenue_Joueurs').html("<i class='material-icons md-icon-spin fa fa-spin' ></i>");
    $('#Contenue_Hommes').html("<i class='material-icons md-icon-spin fa fa-spin' ></i>");
    $('#Contenue_Femmes').html("<i class='material-icons md-icon-spin fa fa-spin' ></i>");
    $('#Contenue_Shinsoo').html("<i class='material-icons md-icon-spin fa fa-spin' ></i>");
    $('#Contenue_Chunjo').html("<i class='material-icons md-icon-spin fa fa-spin' ></i>");
    $('#Contenue_Jinno').html("<i class='material-icons md-icon-spin fa fa-spin' ></i>");
    $('#Contenue_Guerriers').html("<i class='material-icons md-icon-spin fa fa-spin' ></i>");
    $('#Contenue_Suras').html("<i class='material-icons md-icon-spin fa fa-spin' ></i>");
    $('#Contenue_Ninjas').html("<i class='material-icons md-icon-spin fa fa-spin' ></i>");
    $('#Contenue_Shamans').html("<i class='material-icons md-icon-spin fa fa-spin' ></i>");

    $('#Contenue_Connexion_Site').html("<i class='material-icons md-icon-spin fa fa-spin' ></i>");
    $('#Contenue_Connexion_Site_Unique').html("<i class='material-icons md-icon-spin fa fa-spin' ></i>");
    $('#Contenue_Changement_Mail').html("<i class='material-icons md-icon-spin fa fa-spin' ></i>");
    $('#Contenue_Recup_MDP').html("<i class='material-icons md-icon-spin fa fa-spin' ></i>");
    $('#Contenue_Changement_MDP').html("<i class='material-icons md-icon-spin fa fa-spin' ></i>");
    $('#Contenue_Changement_Code_Entrepot').html("<i class='material-icons md-icon-spin fa fa-spin' ></i>");
    $('#Contenue_Deblocage_Yangs').html("<i class='material-icons md-icon-spin fa fa-spin' ></i>");
    $('#Contenue_Nombre_Vote').html("<i class='material-icons md-icon-spin fa fa-spin' ></i>");
    $('#Contenue_Nombre_Achat_Perso').html("<i class='material-icons md-icon-spin fa fa-spin' ></i>");

    $('#Contenue_Tickets_Ouverts').html("<i class='material-icons md-icon-spin fa fa-spin' ></i>");
    $('#Contenue_Messages_Ecrits').html("<i class='material-icons md-icon-spin fa fa-spin' ></i>");
    $('#Contenue_Discussions_Archives').html("<i class='material-icons md-icon-spin fa fa-spin' ></i>");

    $('#Contenue_Pays_FR').html("<i class='material-icons md-icon-spin fa fa-spin' ></i>");
    $('#Contenue_Pays_CH').html("<i class='material-icons md-icon-spin fa fa-spin' ></i>");
    $('#Contenue_Pays_GB').html("<i class='material-icons md-icon-spin fa fa-spin' ></i>");
    $('#Contenue_Pays_DE').html("<i class='material-icons md-icon-spin fa fa-spin' ></i>");
    $('#Contenue_Pays_RO').html("<i class='material-icons md-icon-spin fa fa-spin' ></i>");
    $('#Contenue_Pays_US').html("<i class='material-icons md-icon-spin fa fa-spin' ></i>");
    $('#Contenue_Pays_IT').html("<i class='material-icons md-icon-spin fa fa-spin' ></i>");
    $('#Contenue_Pays_ES').html("<i class='material-icons md-icon-spin fa fa-spin' ></i>");
    $('#Contenue_Pays_PL').html("<i class='material-icons md-icon-spin fa fa-spin' ></i>");
    $('#Contenue_Pays_PT').html("<i class='material-icons md-icon-spin fa fa-spin' ></i>");
    $('#Contenue_Pays_TN').html("<i class='material-icons md-icon-spin fa fa-spin' ></i>");
    $('#Contenue_Pays_DZ').html("<i class='material-icons md-icon-spin fa fa-spin' ></i>");
    $('#Contenue_Pays_JP').html("<i class='material-icons md-icon-spin fa fa-spin' ></i>");
    $('#Contenue_Pays_BE').html("<i class='material-icons md-icon-spin fa fa-spin' ></i>");

    Pace.track(function () {

        $.ajax({
            type: "POST",
            url: "pages/Statistiques/ajax/StatistiquesGet.php",
            data: {"page": page},
            success: function (msg) {

                hideLoading();

                var json = JSON.parse(msg);

                var data = [];
                var myPieChartRoyaume = new Chart(ctxRoyaume).Doughnut(data, {
                    animationEasing: "easeOutBounce",
                    segmentStrokeWidth: 0,
                    segmentShowStroke: false,
                    segmentStrokeColor: "#666",
                    tooltipCornerRadius: 0,
                    tooltipFontSize: 11,
                    responsive: true,
                    legendTemplate: '<ul style=\"list-style-type:none; padding-left:0px;\" class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>; display:inline-block; width:10px; height:10px;\"></span>&nbsp;<%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
                });

                myPieChartRoyaume.addData({
                    value: json.shinsoo,
                    color: "#dd4b39",
                    highlight: "#E05D4C",
                    label: "Shinsoo"
                });

                myPieChartRoyaume.addData({
                    value: json.chunjo,
                    color: "#f39c12",
                    highlight: "#F4A529",
                    label: "Chunjo"
                });

                myPieChartRoyaume.addData({
                    value: json.jinno,
                    color: "#0073b7",
                    highlight: "#1981BE",
                    label: "Jinno"
                });

                $("#myChartRoyaumeLegend").html(myPieChartRoyaume.generateLegend());

                var myPieChartJob = new Chart(ctxJob).Doughnut(data, {
                    animationEasing: "easeOutBounce",
                    segmentStrokeWidth: 0,
                    segmentShowStroke: false,
                    segmentStrokeColor: "#666",
                    tooltipCornerRadius: 0,
                    tooltipFontSize: 11,
                    responsive: true,
                    legendTemplate: '<ul style=\"list-style-type:none; padding-left:0px;\" class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>; display:inline-block; width:10px; height:10px;\"></span>&nbsp;<%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
                });

                myPieChartJob.addData({
                    value: json.guerriers,
                    color: "#dd4b39",
                    highlight: "#E05D4C",
                    label: "Guerriers"
                });

                myPieChartJob.addData({
                    value: json.suras,
                    color: "#d2d6de",
                    highlight: "#D6DAE1",
                    label: "Suras"
                });

                myPieChartJob.addData({
                    value: json.ninjas,
                    color: "#00a65a",
                    highlight: "#19AE6A",
                    label: "Ninjas"
                });

                myPieChartJob.addData({
                    value: json.shamans,
                    color: "#f39c12",
                    highlight: "#F4A529",
                    label: "Shamans"
                });

                $("#myChartJobLegend").html(myPieChartJob.generateLegend());

                $("#Contenue_Comptes").html(json.comptes);
                $("#Contenue_Joueurs").html(json.joueurs);

                $("#Contenue_Hommes").html(json.hommes);
                $("#Contenue_Femmes").html(json.femmes);

                $("#Contenue_Connexion_Site").html(json.connexion_site);
                $("#Contenue_Connexion_Site_Unique").html(json.connexion_site_unique);
                $("#Contenue_Changement_Mail").html(json.changement_mail);
                $("#Contenue_Recup_MDP").html(json.recup_mdp);
                $("#Contenue_Changement_MDP").html(json.changement_mdp);
                $("#Contenue_Changement_Code_Entrepot").html(json.changement_entrepot);
                $("#Contenue_Deblocage_Yangs").html(json.deblocage_yangs);
                $("#Contenue_Nombre_Vote").html(json.nombre_vote);
                $("#Contenue_Nombre_Achat_Perso").html(json.nombre_achats_perso);

                $("#Contenue_Tickets_Ouverts").html(json.tickets_ouvert);
                $("#Contenue_Messages_Ecrits").html(json.message_ecrits);
                $("#Contenue_Discussions_Archives").html(json.discussion_archives);

                $("#Contenue_Pays_FR").html(json.pays_fr);
                $("#Contenue_Pays_CH").html(json.pays_ch);
                $("#Contenue_Pays_GB").html(json.pays_gb);
                $("#Contenue_Pays_DE").html(json.pays_de);
                $("#Contenue_Pays_RO").html(json.pays_ro);
                $("#Contenue_Pays_US").html(json.pays_us);
                $("#Contenue_Pays_IT").html(json.pays_it);
                $("#Contenue_Pays_ES").html(json.pays_es);
                $("#Contenue_Pays_PL").html(json.pays_pl);
                $("#Contenue_Pays_PT").html(json.pays_pt);
                $("#Contenue_Pays_TN").html(json.pays_tn);
                $("#Contenue_Pays_DZ").html(json.pays_dz);
                $("#Contenue_Pays_JP").html(json.pays_jp);
                $("#Contenue_Pays_BE").html(json.pays_be);

                if (objet !== false) {
                    $(".nav-tabs-custom li").attr("class", "");
                    $(objet).parent("li").attr("class", "active");
                }

            }
        });
    });
}