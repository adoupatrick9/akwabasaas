$(document).ready(function() {

    $('.chargement').hide(1000); // cache la division au départ
    $('.chargeM').hide();

    $('#ap_type_pers').change(function() {
        var TypePersonne = $('#ap_type_pers option:selected').val();
        if (TypePersonne == 2) {
            $('.genreN').hide(1000);
        } else {
            $('.genreN').show(1000);
        }
    });

    $('#ap_type').change(function() {
        var TypePersonne = $('#ap_type option:selected').val();
        if (TypePersonne == 2) {
            $('.genreE').hide(1000);
        } else {
            $('.genreE').show(1000);
        }
    });

    $('#addClient').submit(function(e) {
        e.preventDefault();
        var _token = $('meta[name="csrf-token"]').attr('content');
        var ap_nom_pers = $('input[name="ap_nom_pers"]').val();
        var ap_prenom_pers = $('input[name="ap_prenom_pers"]').val();
        var ap_login_pers = $('input[name="ap_login_pers"]').val();
        var ap_type_pers = $('#ap_type_pers option:selected').val();
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

        if (ap_type_pers == "" || ap_nom_pers == "" ||
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
            url: "/utilisateurs-create/client",
            data: {
                ap_nom_pers: ap_nom_pers,
                ap_prenom_pers: ap_prenom_pers,
                ap_login_pers: ap_login_pers,
                ap_type_pers: ap_type_pers,
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
                ap_adressegeo_pers: ap_adressegeo_pers
            },
            dataType: 'json',
            success: function(response) {
                if (response.status == 302) {
                    alert('Client non enregistré');
                    return false;
                }
                alert("Le client a bien été enregistré.");
                window.location.replace("/utilisateurs/client");
            },
            error: function(response) {
                console.log(response);
            }
        });
    });

    //Modifier une service
    $('.editer').click(function() {
        var id = $(this).attr('id');
        $.ajax({
            type: "get",
            url: "/utilisateurs-edit/" + id + "/client",
            dataType: "json",
            success: function(data) {
                $('#ap_nom_pers').val(data.ap_nom_pers);
                $('#ap_prenom_pers').val(data.ap_prenom_pers);
                $('#ap_login_pers').val(data.ap_login_pers);
                $('#ap_type option[value="' + data.ap_type_pers + '"]').prop('selected', true);
                $('#ap_genre option[value="' + data.ap_genre_pers + '"]').prop('selected', true);
                $('#ap_datenais_pers').val(data.ap_datenais_pers);
                $('#ap_lieunai_pers').val(data.ap_lieunai_pers);
                $('#ap_typepiece_pers').val(data.ap_typepiece_pers);
                $('#ap_numeropiece_pers').val(data.ap_numeropiece_pers);
                $('#ap_mobile_pers').val(data.ap_mobile_pers);
                $('#ap_telephone_pers').val(data.ap_telephone_pers);
                $('#ap_email_pers').val(data.ap_email_pers);
                $('#ap_pays option[value="' + data.ap_pays_pers + '"]').prop('selected', true);
                $('#ap_ville_pers').val(data.ap_ville_pers);
                $('#ap_siteweb_pers').val(data.ap_siteweb_pers);
                $('#ap_adressepostale_pers').val(data.ap_adressepostale_pers);
                $('#ap_adressegeo_pers').val(data.ap_adressegeo_pers);
                if (data.ap_type_pers == 2) {
                    $('.genreE').hide(1000);
                } else {
                    $('.genreE').show(1000);
                }
                $('#editClient').attr('action', '/utilisateurs-update/' + id + '/client');
                $('#IDas_personne').val(id);
                $('#myModalEditClient').modal('show');
            },
            error: function(data) {
                console.log(data);
            }
        });
    });
    $('#editClient').submit(function(e) {
        e.preventDefault();
        var _token = $('meta[name="csrf-token"]').attr('content');
        var ap_nom_pers = $('#ap_nom_pers').val();
        var ap_prenom_pers = $('#ap_prenom_pers').val();
        var ap_login_pers = $('#ap_login_pers').val();
        var ap_type_pers = $('#ap_type option:selected').val();
        var ap_genre_pers = $('#ap_genre option:selected').val();
        var ap_datenais_pers = $('#ap_datenais_pers').val();
        var ap_lieunai_pers = $('#ap_lieunai_pers').val();
        var ap_typepiece_pers = $('#ap_typepiece_pers').val();
        var ap_numeropiece_pers = $('#ap_numeropiece_pers').val();
        var ap_mobile_pers = $('#ap_mobile_pers').val();
        var ap_telephone_pers = $('#ap_telephone_pers').val();
        var ap_email_pers = $('#ap_email_pers').val();
        var ap_pays_pers = $('#ap_pays option:selected').val();
        var ap_ville_pers = $('#ap_ville_pers').val();
        var ap_siteweb_pers = $('#ap_siteweb_pers').val();
        var ap_adressepostale_pers = $('#ap_adressepostale_pers').val();
        var ap_adressegeo_pers = $('#ap_adressegeo_pers').val();

        if (ap_type_pers == "" || ap_nom_pers == "" ||
            ap_mobile_pers == "" || ap_email_pers == "" ||
            ap_login_pers == "" || ap_ville_pers == "" ||
            ap_pays_pers == "" || ap_genre_pers == "") {
            alert('Veuillez renseigner tous les champs obligatoires.');
            return false;
        }
        var IDas_personne = $('#IDas_personne').val();
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
                IDas_personne: IDas_personne,
                ap_nom_pers: ap_nom_pers,
                ap_prenom_pers: ap_prenom_pers,
                ap_login_pers: ap_login_pers,
                ap_type_pers: ap_type_pers,
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
                ap_adressegeo_pers: ap_adressegeo_pers
            },
            dataType: "json",
            success: function(data) {
                alert('Client mis à jour.');
                window.location.replace("/utilisateurs/client");
            },
            error: function(data) {
                console.log(data);
            }
        });
    });

    // Supprimer
    $('.supprimer').click(function() {
        var rep = confirm("Voulez-vous supprimer ce client ?");
        if (rep == false) {
            return false;
        }
        var id = $(this).attr('id');
        $.ajax({
            type: "get",
            url: "/utilisateurs-delete/" + id + "/client",
            dataType: "json",
            success: function(data) {
                alert('Client supprimée');
                window.location.replace("/utilisateurs/client");
            },
            error: function(data) {
                console.log(data);
            }
        });

    });
});