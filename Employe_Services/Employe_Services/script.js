$("input").keyup(function () {
    $.get("traitementEmploye.php?action=btnSupp")
        .done(function(data){
            var btnSupp = JSON.parse(data);
            var nom = $("#nomFiltre").val();
            var prenom = $("#prenomFiltre").val();
            var emploi = $("#emploiFiltre").val();
            var service = $("#serviceFiltre").val();
            $.get("traitementEmploye.php?action=filtrage", { NOM: nom, PRENOM: prenom, EMPLOI: emploi, SERVICE: service })
                .done(function (data) {
                    $("tbody").empty();
                    var result = JSON.parse(data);
                    for (var i = 0; i < result.length; i++) {
                        if (session === "Admin") {
                            var sal = $("<td class='tdData' >").html(result[i].sal);
                            var comm = $("<td class='tdData' >").html(result[i].comm);
                            var modif = $("<td class='tdData'>").append($("<a href='traitementFormEmp.php?action=modif&NOEMP=" + result[i].noEmp + "&NOSERV=" + result[i].noServ + "'>")
                                        .append($("<button class='btn btn-primary'>").html("Modifier les informations")));
                        
                                        
                        } else if (session === "User") {
                            var sal = null;
                            var comm = null;
                            var modif = null;
                        }
                        $("tbody").append(
                            $("<tr>").append($("<td class='tdData'>").html(result[i].noEmp),
                                ($("<td class='tdData'>").html(result[i].nom)),
                                ($("<td class='tdData'>").html(result[i].prenom)),
                                ($("<td class='tdData'>").html(result[i].emploi)),
                                ($("<td class='tdData'>").html(result[i].sup)),
                                ($("<td class='tdData' >").html(result[i].embauche)),
                                (sal),
                                (comm),
                                ($("<td class='tdData'>").html(result[i].noServ)),
                                (modif),
                                ($("<td class='tdData" +i+ "'>").html($("<a href='traitementEmploye.php?action=delete&NOEMP=" + result[i].noEmp + "'>").append($("<button class='btn btn-danger'>").html("Supprimer la ligne"))))));
                                if (session === "Admin") {
                                    $.each( btnSupp, function( key, value ) {
                                        if (value === result[i].noEmp) {
                                            $('.tdData'+i).empty();
                                            
                                      }
                                    })
                                } else if (session === "User") {
                                    $('.tdData'+i).empty();
                                    
                                }
                    }
                })
        })
})