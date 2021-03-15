$(document).ready(function() {

    $('#addService').submit(function(e) {
        e.preventDefault();
       
        var _token = $('meta[name="csrf-token"]').attr('content');
        var sce_nom_service = $('input[name="sce_nom_service"]').val();
        var sce_type = $('#sce_type_service option:selected').val();

        if (sce_nom_service == "" || sce_type == "") {
            alert('Aucun champ ne doit être vide.');
            $('input[name="sce_nom_service"]').focus();
            return false;
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': _token,
            }
        });
        $.ajax({
            type: "post",
            url: "/services-create",
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
                window.location.replace("/services");
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
            url: "/services-edit/" + id + "/services",
            dataType: "json",
            success: function(data) {
                $('#sce_nom_service').val(data.Sce_nom_service);
                $('#sce_type option[value='+data.Sce_type_service+']').prop('selected', true);
                $('#editService').attr('action', '/services-update/' + id);
                $('#IDas_service').val(id);
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
        var IDas_service = $('#IDas_service').val();
        var MonUrl = $(this).attr('action');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': _token,
            }
        });
        $.ajax({
            type: "post",
            url: MonUrl,
            data: {
                IDas_service: IDas_service,
                sce_nom_service: sce_nom_service,
                sce_type: sce_type
            },
            dataType: "json",
            success: function(data) {
                alert('service mis à jour.');
                window.location.replace("/services");
            },
            error: function(data) {
                console.log(data);
            }
        });
    });

    // Supprimer
     $('.supprimer').click(function() {
        var rep = confirm("Voulez-vous supprimer ce service ?");
        if (rep == false) {
            return false;
        }
        var id = $(this).attr('id');
        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: "get",
            url: "/services-delete/" + id,
            dataType: "json",
            success: function(data) {
                alert('Service supprimée');
                window.location.replace("/services");
            },
            error: function(data) {
                 console.log(data);
            }
        });

    });
});