$(document).ready(function() {

    $('.chargement').hide(1000); // cache la division au départ
    $('.chargeM').hide();

    $('#addPromo').submit(function(e) {
        e.preventDefault();

        var _token = $('meta[name="csrf-token"]').attr('content');
        var pro_intitule = $('input[name="pro_intitule"]').val();
        var Sce_code_service = $('#Sce_code_service option:selected').val();
        var dev_code_devise = $('#dev_code_devise option:selected').val();
        var pro_debut_periode = $('input[name="pro_debut_periode"]').val();
        var pro_fin_periode = $('input[name="pro_fin_periode"]').val();
        var pro_cout_unitaire = $('input[name="pro_cout_unitaire"]').val();
        var pro_cout_mensuel = $('input[name="pro_cout_mensuel"]').val();
        var pro_cout_trimestriel = $('input[name="pro_cout_trimestriel"]').val();
        var pro_cout_semestriel = $('input[name="pro_cout_semestriel"]').val();
        var pro_cout_annuel = $('input[name="pro_cout_annuel"]').val();
        var urlEnr = $(this).attr('action');

        if (pro_intitule == "" || Sce_code_service == "" ||
            dev_code_devise == "" || pro_debut_periode == "" ||
            pro_fin_periode == "" || pro_cout_unitaire == "" ||
            pro_cout_mensuel == "" || pro_cout_trimestriel == "" ||
            pro_cout_semestriel == "" || pro_cout_annuel == "") {
            alert('Aucun champ ne doit être vide.');
            $('input[name="pro_intitule"]').focus();
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
                pro_intitule: pro_intitule,
                Sce_code_service: Sce_code_service,
                dev_code_devise: dev_code_devise,
                pro_debut_periode: pro_debut_periode,
                pro_fin_periode: pro_fin_periode,
                pro_cout_unitaire: pro_cout_unitaire,
                pro_cout_mensuel: pro_cout_mensuel,
                pro_cout_trimestriel: pro_cout_trimestriel,
                pro_cout_semestriel: pro_cout_semestriel,
                pro_cout_annuel: pro_cout_annuel
            },
            dataType: 'json',
            success: function(response) {
                if (response.status == 302) {
                    alert('Promotion non enregistrée');
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
                $('#pro_intitule').val(data.pro_intitule);
                $('#Sce_code option[value=' + data.sce_code_service + ']').prop('selected', true);
                $('#Dev_code option[value=' + data.dev_code_devise + ']').prop('selected', true);
                $('#pro_debut_periode').val(data.pro_debut_periode);
                $('#pro_fin_periode').val(data.pro_fin_periode);
                $('#pro_cout_unitaire').val(data.pro_cout_unitaire);
                $('#pro_cout_mensuel').val(data.pro_cout_mensuel);
                $('#pro_cout_trimestriel').val(data.pro_cout_trimestriel);
                $('#pro_cout_semestriel').val(data.pro_cout_semestriel);
                $('#pro_cout_annuel').val(data.pro_cout_annuel);
                var urlUpdate = $('#editPromo').attr('action') + '/' + id;
                $('#editPromo').attr('action', urlUpdate);
                $('#idas_promotion').val(id);
                $('#myModalEditPromo').modal('show');
            },
            error: function(data) {
                console.log(data);
            }
        });
    });
    $('#editPromo').submit(function(e) {
        e.preventDefault();
        var _token = $('meta[name="csrf-token"]').attr('content');
        var pro_intitule = $('#pro_intitule').val();
        var Sce_code_service = $('#Sce_code option:selected').val();
        var dev_code_devise = $('#Dev_code option:selected').val();
        var pro_debut_periode = $('#pro_debut_periode').val();
        var pro_fin_periode = $('#pro_fin_periode').val();
        var pro_cout_unitaire = $('#pro_cout_unitaire').val();
        var pro_cout_mensuel = $('#pro_cout_mensuel').val();
        var pro_cout_trimestriel = $('#pro_cout_trimestriel').val();
        var pro_cout_semestriel = $('#pro_cout_semestriel').val();
        var pro_cout_annuel = $('#pro_cout_annuel').val();

        if (pro_intitule == "" || Sce_code_service == "" ||
            dev_code_devise == "" || pro_debut_periode == "" ||
            pro_fin_periode == "" || pro_cout_unitaire == "" ||
            pro_cout_mensuel == "" || pro_cout_trimestriel == "" ||
            pro_cout_semestriel == "" || pro_cout_annuel == "") {
            alert('Aucun champ ne doit être vide.');
            $('#pro_intitule').focus();
            return false;
        }
        var idas_promotion = $('#idas_promotion').val();
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
                idas_promotion: idas_promotion,
                pro_intitule: pro_intitule,
                Sce_code_service: Sce_code_service,
                dev_code_devise: dev_code_devise,
                pro_debut_periode: pro_debut_periode,
                pro_fin_periode: pro_fin_periode,
                pro_cout_unitaire: pro_cout_unitaire,
                pro_cout_mensuel: pro_cout_mensuel,
                pro_cout_trimestriel: pro_cout_trimestriel,
                pro_cout_semestriel: pro_cout_semestriel,
                pro_cout_annuel: pro_cout_annuel
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
        var rep = confirm("Voulez-vous supprimer cette promotion ?");
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