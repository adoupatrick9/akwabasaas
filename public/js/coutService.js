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
                cs_cout_annuel: cs_cout_annuel
            },
            dataType: 'json',
            success: function(response) {
                if (response.status == 302) {
                    alert("Le service client n'a pas pu être ajouté.");
                    return false;
                }
                alert("Le service client a bien été ajouté.");
                //window.location.replace("utilisateurs-portefeuille/" + IDPartenaire + "/partenaire");
            },
            error: function(response) {
                console.log(response);
            }
        });
    });

    // Supprimer
    $('.supprimer').click(function() {
        var rep = confirm("Voulez-vous retirer ce service client ?");
        if (rep == false) {
            return false;
        }
        var id = $(this).attr('id');
        $.ajax({
            type: "get",
            url: "/utilisateurs-partenaire-portefeuille-retirer/" + id,
            dataType: "json",
            success: function(data) {
                alert('Client retiré du portefeuille');
                window.location.replace('utilisateurs-portefeuille/' + id + '/partenaire');
            },
            error: function(data) {
                console.log(data);
            }
        });

    });
});