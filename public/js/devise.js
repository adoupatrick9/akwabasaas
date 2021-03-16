$(document).ready(function() {

    $('.chargement').hide(1000); // cache la division au départ
    $('.chargeM').hide();

    // Ajouter une devise
    $('.addDevise').click(function() {
        $('#myModalStoreDevise').modal('show');
    })
    $('#storeDevise').submit(function(e) {
        e.preventDefault();
        var _token = $('input[name="_token"]').val();
        var intitule = $('input[name="dev_intitule_devise"]').val();
        if (intitule == "") {
            alert('Le nom de la devise ne doit pas être vide.');
            $('input[name="dev_intitule_devise"]').focus();
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
            url: "/devises-create",
            data: {
                dev_intitule_devise: intitule
            },
            dataType: 'html',
            success: function(response) {
                if (response.status == 302) {
                    alert('Devise non enregistrée');
                    return false;
                }
                alert('La devise a bien été enregistré.');
                window.location.replace("/configurations");
            },
            error: function(response) {
                console.log(response);
            }
        });
    });

    //Modifier une devise
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
            url: "/devises-edit/" + id + "/configurations",
            dataType: "json",
            success: function(data) {
                $('#dev_intitule_devise').val(data.dev_intitule_devise);
                $('#EditDevise').attr('action', '/devises-update/' + id);
                $('#idas_devise').val(id);
                $('#myModalEditDevise').modal('show');
            },
            error: function(data) {
                console.log(data);
            }
        });
    });
    $('#EditDevise').submit(function(e) {
        e.preventDefault();
        var _token = $('meta[name="csrf-token"]').attr('content');
        var dev_intitule_devise = $('#dev_intitule_devise').val();
        var idas_devise = $('#idas_devise').val();
        var MonUrl = $(this).attr('action');
        if (dev_intitule_devise == "") {
            alert('Le nom de la devise ne doit pas être vide.');
            $('input[name="dev_intitule_devise"]').focus();
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
            url: MonUrl,
            data: {
                idas_devise: idas_devise,
                dev_intitule_devise: dev_intitule_devise
            },
            dataType: "json",
            success: function(data) {
                alert('Devise mise à jour.');
                window.location.replace("/configurations");
            },
            error: function(data) {
                console.log(data);
            }
        });
    });

    // Supprimer
    $('.supprimer').click(function() {
        var rep = confirm("Voulez-vous supprimer cette devise ?");
        if (rep == false) {
            return false;
        }
        var id = $(this).attr('id');
        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: "get",
            url: "/devises-delete/" + id,
            dataType: "json",
            success: function(data) {
                alert('Devise supprimée');
                window.location.replace("/configurations");
            },
            error: function(data) {
                console.log(data);
            }
        });

    });
});