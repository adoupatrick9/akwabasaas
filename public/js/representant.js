$(document).ready(function() {

    $('.chargement').hide(1000); // cache la division au départ
    $('.chargeM').hide();

    $('#addRepresentant').submit(function(e) {
        e.preventDefault();
        var _token = $('meta[name="csrf-token"]').attr('content');
        var ap_nom_pers = $('input[name="ap_nom_pers"]').val();
        var ap_prenom_pers = $('input[name="ap_prenom_pers"]').val();
        var ap_login_pers = $('input[name="ap_login_pers"]').val();
        var ap_genre_pers = $('#ap_genre_pers option:selected').val();
        var ap_datenais_pers = $('input[name="ap_datenais_pers"]').val();
        var ap_lieunai_pers = $('input[name="ap_lieunai_pers"]').val();
        var ap_typepiece_pers = $('input[name="ap_typepiece_pers"]').val();
        var ap_numeropiece_pers = $('input[name="ap_numeropiece_pers"]').val();
        var ap_mobile_pers = $('input[name="ap_mobile_pers"]').val();
        var ap_telephone_pers = $('input[name="ap_telephone_pers"]').val();
        var ap_email_pers = $('input[name="ap_email_pers"]').val();
        var ap_pays_pers = $('#ap_pays_pers option:selected').val();
        var ap_ville_pers = $('input[name="ap_ville_pers"]').val();
        var ap_siteweb_pers = $('input[name="ap_siteweb_pers"]').val();
        var ap_adressepostale_pers = $('input[name="ap_adressepostale_pers"]').val();
        var ap_adressegeo_pers = $('input[name="ap_adressegeo_pers"]').val();
        var matricule = $('#matricule').val();
        var IDpartenaire = $('#IDpartenaire').val();

        if (ap_nom_pers == "" ||
            ap_mobile_pers == "" || ap_email_pers == "" ||
            ap_login_pers == "" || ap_ville_pers == "" ||
            ap_pays_pers == "" || ap_genre_pers == "") {
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
            url: "/utilisateurs-marquer-interlocuteur-representant/" + matricule,
            data: {
                ap_nom_pers: ap_nom_pers,
                ap_prenom_pers: ap_prenom_pers,
                ap_login_pers: ap_login_pers,
                ap_type_pers: 1,
                ap_genre_pers: ap_genre_pers,
                ap_datenais_pers: ap_datenais_pers,
                ap_lieunai_pers: ap_lieunai_pers,
                ap_typepiece_pers: ap_typepiece_pers,
                ap_numeropiece_pers: ap_numeropiece_pers,
                ap_mobile_pers: ap_mobile_pers,
                ap_telephone_pers: ap_telephone_pers,
                ap_email_pers: ap_email_pers,
                ap_pays_pers: ap_pays_pers,
                ap_ville_pers: ap_ville_pers,
                ap_siteweb_pers: ap_siteweb_pers,
                ap_adressepostale_pers: ap_adressepostale_pers,
                ap_adressegeo_pers: ap_adressegeo_pers,
                matriculePartenaire: matricule
            },
            dataType: 'json',
            success: function(response) {
                if (response.status == 302) {
                    alert('Représentant non enregistré');
                    return false;
                }
                alert("Le représentant a bien été enregistré.");
                window.location.replace('/utilisateurs-representant/' + IDpartenaire + '/partenaire');
            },
            error: function(response) {
                console.log(response);
            }
        });
    });

});