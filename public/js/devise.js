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
        var urlEnr = $(this).attr('action');
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
            url: urlEnr,
            data: {
                dev_intitule_devise: intitule
            },
            dataType: 'html',
            success: function(response) {
                if (response.status == 302) {
                    alert('Devise non enregistrée');
                    return false;
                }
                window.location.reload();
            },
            error: function(response) {
                console.log(response);
            }
        });
    });

    //Modifier une devise
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
                $('#dev_intitule_devise').val(data.dev_intitule_devise);
                var urlUpdate = $('#EditDevise').attr('action') + '/' + id;
                $('#EditDevise').attr('action', urlUpdate);
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
        var rep = confirm("Voulez-vous supprimer cette devise ?");
        if (rep == false) {
            return false;
        }
        var urlSup = $(this).attr('href');
        var _token = $('meta[name="csrf-token"]').attr('content');
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