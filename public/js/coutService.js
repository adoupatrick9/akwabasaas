$(document).ready(function() {

    $('.chargement').hide(1000); // cache la division au départ
    $('.chargeM').hide();

    $('#addCoutService').submit(function(e) {
        e.preventDefault();
        var _token = $('meta[name="csrf-token"]').attr('content');
        var cs_intitule = $('input[name="cs_intitule"]').val();
        var dev_code_devise = $('#dev_code_devise option:selected').val();
        var cs_type_service = $('#cs_type_service option:selected').val();
        var cs_frequence = $('input[name="cs_frequence"]').val();
        var cs_cout_borne = $('input[name="cs_cout_borne"]').val();
        var cs_borne_inferieure = $('input[name="cs_borne_inferieure"]').val();
        var cs_borne_superieure = $('input[name="cs_borne_superieure"]').val();
        var cs_cout_mensuel = $('input[name="cs_cout_mensuel"]').val();
        var cs_cout_trimestriel = $('input[name="cs_cout_trimestriel"]').val();
        var cs_cout_semestriel = $('input[name="cs_cout_semestriel"]').val();
        var cs_cout_annuel = $('input[name="cs_cout_annuel"]').val();
        var idas_service = $('input[name="idas_service"]').val();
        if (cs_intitule == "" || dev_code_devise == "" || cs_cout_mensuel == "" || cs_cout_trimestriel == "" ||
            cs_type_service == "" || cs_frequence == "" || cs_cout_semestriel == "" || cs_cout_annuel == "" ||
            cs_cout_borne == "" || cs_borne_inferieure == "" ||
            cs_borne_superieure == "") {
            alert('Veuillez renseigner tous les champs obligatoires.');
            return false;
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': _token,
            },
            beforeSend: function() {
                $('.chargement').show();
            },
            complete: function() {
                $('.chargement').hide();
            },
        });
        $.ajax({
            type: "post",
            url: "/couts-service-create/" + idas_service,
            data: {
                cs_intitule: cs_intitule,
                dev_code_devise: dev_code_devise,
                cs_type_service: cs_type_service,
                cs_frequence: cs_frequence,
                cs_cout_borne: cs_cout_borne,
                cs_borne_inferieure: cs_borne_inferieure,
                cs_borne_superieure: cs_borne_superieure,
                cs_cout_mensuel: cs_cout_mensuel,
                cs_cout_trimestriel: cs_cout_trimestriel,
                cs_cout_semestriel: cs_cout_semestriel,
                cs_cout_annuel: cs_cout_annuel,
            },
            dataType: 'json',
            success: function(response) {
                //console.log(response);
                if (response.status == 302) {
                    alert("Le coût service n'a pas pu être ajouté.");
                    return false;
                }
                alert("Le coût service a bien été ajouté.");
                window.location.replace('services-coutservice/' + idas_service + '/service');
            },
            error: function(response) {
                console.log(response);
            }
        });
    });

    //Modifier un coût service
    $('.editer').click(function() {
        var id = $(this).attr('id');
        $.ajaxSetup({
            beforeSend: function() {
                $('.chargeM').show();
            },
            complete: function() {
                $('.chargeM').hide();
            },
        });
        $.ajax({
            type: "get",
            url: "/couts-service-edit/" + id,
            dataType: "json",
            success: function(data) {
                $('#cs_intitule').val(data.cs_intitule);
                $('#dev_code option[value="' + data.dev_code_devise + '"]').prop('selected', true);
                $('#cs_type option[value="' + data.cs_type_service + '"]').prop('selected', true);
                $('#cs_frequence').val(data.cs_frequence);
                $('#cs_cout_borne').val(data.cs_cout_borne);
                $('#cs_borne_inferieure').val(data.cs_borne_inferieure);
                $('#cs_borne_superieure').val(data.cs_borne_superieure);
                $('#cs_cout_mensuel').val(data.cs_cout_mensuel);
                $('#cs_cout_trimestriel').val(data.cs_cout_trimestriel);
                $('#cs_cout_semestriel').val(data.cs_cout_semestriel);
                $('#cs_cout_annuel').val(data.cs_cout_annuel);
                var idas_service = $('#idas_service').val();
                $.ajaxSetup({
                    beforeSend: function() {
                        $('.chargement').show();
                    },
                    complete: function() {
                        $('.chargement').hide();
                    },
                });
                $('#idas_cout_service').val(id);
                $('#editCoutService').attr('action', '/couts-service-update/' + id + '/' + idas_service);
                $('#myModalEditCoutService').modal('show');
            },
            error: function(data) {
                console.log(data);
            }
        });
    });
    $('#editCoutService').submit(function(e) {
        e.preventDefault();
        var _token = $('meta[name="csrf-token"]').attr('content');
        var cs_intitule = $('#cs_intitule').val();
        var dev_code_devise = $('#dev_code option:selected').val();
        var cs_type_service = $('#cs_type option:selected').val();
        var cs_frequence = $('#cs_frequence').val();
        var cs_cout_borne = $('#cs_cout_borne').val();
        var cs_borne_inferieure = $('#cs_borne_inferieure').val();
        var cs_borne_superieure = $('#cs_borne_superieure').val();
        var cs_cout_mensuel = $('#cs_cout_mensuel').val();
        var cs_cout_trimestriel = $('#cs_cout_trimestriel').val();
        var cs_cout_semestriel = $('#cs_cout_semestriel').val();
        var cs_cout_annuel = $('#cs_cout_annuel').val();
        var idas_service = $('#idas_service').val();
        var idas_cout_service = $('#idas_cout_service').val();
        if (cs_intitule == "" || dev_code_devise == "" || cs_cout_mensuel == "" || cs_cout_trimestriel == "" ||
            cs_type_service == "" || cs_frequence == "" || cs_cout_semestriel == "" || cs_cout_annuel == "" ||
            cs_cout_borne == "" || cs_borne_inferieure == "" ||
            cs_borne_superieure == "") {
            alert('Veuillez renseigner tous les champs obligatoires.');
            return false;
        }
        var MonUrl = $(this).attr('action');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': _token,
            },
            beforeSend: function() {
                $('.chargement').show();
            },
            complete: function() {
                $('.chargement').hide();
            },
        });
        $.ajax({
            type: "post",
            url: MonUrl,
            data: {
                idas_cout_service: idas_cout_service,
                cs_intitule: cs_intitule,
                dev_code_devise: dev_code_devise,
                cs_type_service: cs_type_service,
                cs_frequence: cs_frequence,
                cs_cout_borne: cs_cout_borne,
                cs_borne_inferieure: cs_borne_inferieure,
                cs_borne_superieure: cs_borne_superieure,
                cs_cout_mensuel: cs_cout_mensuel,
                cs_cout_trimestriel: cs_cout_trimestriel,
                cs_cout_semestriel: cs_cout_semestriel,
                cs_cout_annuel: cs_cout_annuel
            },
            dataType: "json",
            success: function(data) {
                alert('Coût service mis à jour.');
                window.location.replace("services-coutservice/" + idas_service + "/services");
            },
            error: function(data) {
                console.log(data);
            }
        });
    });

    // Supprimer
    $('.supprimer').click(function() {
        var rep = confirm("Voulez-vous retirer ce coût service ?");
        if (rep == false) {
            return false;
        }
        var id = $(this).attr('id');
        $.ajax({
            type: "get",
            url: "/couts-service-delete/" + id,
            dataType: "json",
            success: function(data) {
                alert('Coût service retiré');
                window.location.replace("services-coutservice/" + id + "/services");
            },
            error: function(data) {
                console.log(data);
            }
        });

    });
});