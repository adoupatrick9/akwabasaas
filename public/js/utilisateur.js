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

    $('#addUtilisateur').submit(function(e) {
        e.preventDefault();

        var _token = $('meta[name="csrf-token"]').attr('content');
        var ap_nom_pers = $('input[name="ap_nom_pers"]').val();
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
        var ap_siteweb_pers = $('input[name="ap_siteweb_pers"]').val()
        var urlEnr = $(this).attr('action');

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
            url: urlEnr,
            data: {
                ap_nom_pers: ap_nom_pers,
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
                ap_siteweb_pers: ap_siteweb_pers
            },
            dataType: 'json',
            success: function(response) {
                if (response.status == 302) {
                    alert('Utilisateur non enregistré');
                    return false;
                }
                window.location.reload();
            },
            error: function(response) {
                console.log(response);
            }
        });
    });

    //Modifier une service
    $('.editer').click(function(e) {
        e.preventDefault();
        var id = $(this).attr('id');
        var urlEdit = $(this).attr('href');
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
            url: urlEdit,
            dataType: "json",
            success: function(data) {
                $('#ap_nom_pers').val(data.ap_nom_pers);
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
                if (data.ap_type_pers == 2) {
                    $('.genreE').hide();
                } else {
                    $('.genreE').show();
                }
                var urlUpdate = $('#editUtilisateur').attr('action') + '/' + id + '/utilisateur';
                $('#editUtilisateur').attr('action', urlUpdate);
                $('#idas_personne').val(id);
                $('#myModalEditUtilisateur').modal('show');
            },
            error: function(data) {
                console.log(data);
            }
        });
    });
    $('#editUtilisateur').submit(function(e) {
        e.preventDefault();
        var _token = $('meta[name="csrf-token"]').attr('content');
        var ap_nom_pers = $('#ap_nom_pers').val();
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

        if (ap_type_pers == "" || ap_nom_pers == "" ||
            ap_mobile_pers == "" || ap_email_pers == "" ||
            ap_login_pers == "" || ap_ville_pers == "" ||
            ap_pays_pers == "" || ap_genre_pers == "") {
            alert('Veuillez renseigner tous les champs obligatoires.');
            return false;
        }
        var idas_personne = $('#idas_personne').val();
        var urlUpdate = $(this).attr('action');
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
            url: urlUpdate,
            data: {
                idas_personne: idas_personne,
                ap_nom_pers: ap_nom_pers,
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
                ap_siteweb_pers: ap_siteweb_pers
            },
            dataType: "json",
            success: function(data) {
                window.location.reload();
            },
            error: function(data) {
                console.log(data);
            }
        });
    });

    // Supprimer
    $('.supprimer').click(function(e) {
        e.preventDefault();
        var rep = confirm("Voulez-vous supprimer cet utilisateur ?");
        if (rep == false) {
            return false;
        }
        var urlSup = $(this).attr('href');
        $.ajax({
            type: "get",
            url: urlSup,
            dataType: "json",
            success: function(data) {
                window.location.reload();
            },
            error: function(data) {
                console.log(data);
            }
        });

    });
});