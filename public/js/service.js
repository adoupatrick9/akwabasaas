$(document).ready(function() {

    $('.chargement').hide(1000); // cache la division au départ
    $('.chargeM').hide();

    $('#addService').submit(function(e) {
        e.preventDefault();

        var _token = $('meta[name="csrf-token"]').attr('content');
        var sce_nom_service = $('input[name="sce_nom_service"]').val();
        var sce_type = $('#sce_type_service option:selected').val();
        var urlEnr = $(this).attr('action');

        if (sce_nom_service == "" || sce_type == "") {
            alert('Aucun champ ne doit être vide.');
            $('input[name="sce_nom_service"]').focus();
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
                sce_nom_service: sce_nom_service,
                sce_type: sce_type
            },
            dataType: 'json',
            success: function(response) {
                if (response.status == 302) {
                    alert('service non enregistrée');
                    return false;
                }
                alert('Le service a bien été enregistré.');
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
                $('#sce_nom_service').val(data.Sce_nom_service);
                $('#sce_type option[value=' + data.Sce_type_service + ']').prop('selected', true);
                var urlUpdate = $('#editService').attr('action') + '/' + id;
                $('#editService').attr('action', urlUpdate);
                $('#idas_service').val(id);
                $('#myModalEditService').modal('show');
            },
            error: function(data) {
                console.log(data);
            }
        });
    });
    $('#editService').submit(function(e) {
        e.preventDefault();
        var _token = $('meta[name="csrf-token"]').attr('content');
        var sce_nom_service = $('#sce_nom_service').val();
        var sce_type = $('#sce_type option:selected').val();
        if (sce_nom_service == "" || sce_type == "") {
            alert('Aucun champ ne doit être vide.');
            $('#sce_nom_service').focus();
            return false;
        }
        var idas_service = $('#idas_service').val();
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
                idas_service: idas_service,
                sce_nom_service: sce_nom_service,
                sce_type: sce_type
            },
            dataType: "json",
            success: function(data) {
                alert('service mis à jour.');
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
        var rep = confirm("Voulez-vous supprimer ce service ?");
        var urlSup = $(this).attr('href');
        if (rep == false) {
            return false;
        }
        $.ajax({
            type: "get",
            url: urlSup,
            dataType: "json",
            success: function(data) {
                alert('Service supprimée');
                window.location.reload();
            },
            error: function(data) {
                console.log(data);
            }
        });

    });
});