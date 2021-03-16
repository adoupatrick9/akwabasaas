$(document).ready(function() {

    $('#addFacture').submit(function(e) {
        e.preventDefault();

        var _token = $('meta[name="csrf-token"]').attr('content');
        var Fac_montant = $('input[name="Fac_montant"]').val();
        var Fac_montant_paye = $('input[name="Fac_montant_paye"]').val();
        var Fac_date_facturation = $('input[name="Fac_date_facturation"]').val();
        var Fac_date_echeance = $('input[name="Fac_date_echeance"]').val();
        var Fac_debut_periode = $('input[name="Fac_debut_periode"]').val();
        var Fac_fin_periode = $('input[name="Fac_fin_periode"]').val();
        var Ap_matricule_pers = $('input[name="Ap_matricule_pers"]').val();
        if (Fac_montant == "" || Fac_montant_paye == "" ||
            Fac_date_facturation == "" || Fac_date_echeance == "" ||
            Fac_debut_periode == "" || Fac_fin_periode == "") {
            alert('Aucun champ ne doit être vide.');
            $('input[name="Fac_montant"]').focus();
            return false;
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': _token,
            }
        });
        $.ajax({
            type: "post",
            url: "/factures-create/" + Ap_matricule_pers,
            data: {
                Fac_montant: Fac_montant,
                Fac_montant_paye: Fac_montant_paye,
                Fac_date_facturation: Fac_date_facturation,
                Fac_date_echeance: Fac_date_echeance,
                Fac_debut_periode: Fac_debut_periode,
                Fac_fin_periode: Fac_fin_periode,
                Ap_matricule_pers: Ap_matricule_pers
            },
            dataType: 'json',
            success: function(response) {
                if (response.status == 302) {
                    alert('Facture non enregistrée');
                    return false;
                }
                alert('La facture a bien été enregistré.');
                window.location.replace("/factures");
            },
            error: function(response) {
                console.log(response);
            }
        });
    });

    /* //Modifier une service
    $('.editer').click(function() {
        var id = $(this).attr('id');
        $.ajax({
            type: "get",
            url: "/promotions-edit/" + id + "/promotions",
            dataType: "json",
            success: function(data) {
                $('#pro_intitule').val(data.pro_intitule);
                $('#Sce_code option[value=' + data.Sce_code_service + ']').prop('selected', true);
                $('#Dev_code option[value=' + data.Dev_code_devise + ']').prop('selected', true);
                $('#pro_debut_periode').val(data.pro_debut_periode);
                $('#pro_fin_periode').val(data.pro_fin_periode);
                $('#pro_cout_unitaire').val(data.pro_cout_unitaire);
                $('#pro_cout_mensuel').val(data.pro_cout_mensuel);
                $('#pro_cout_trimestriel').val(data.pro_cout_trimestriel);
                $('#pro_cout_semestriel').val(data.pro_cout_semestriel);
                $('#pro_cout_annuel').val(data.pro_cout_annuel);
                $('#editPromo').attr('action', '/promotions-update/' + id);
                $('#IDas_promotion').val(id);
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
        var Dev_code_devise = $('#Dev_code option:selected').val();
        var pro_debut_periode = $('#pro_debut_periode').val();
        var pro_fin_periode = $('#pro_fin_periode').val();
        var pro_cout_unitaire = $('#pro_cout_unitaire').val();
        var pro_cout_mensuel = $('#pro_cout_mensuel').val();
        var pro_cout_trimestriel = $('#pro_cout_trimestriel').val();
        var pro_cout_semestriel = $('#pro_cout_semestriel').val();
        var pro_cout_annuel = $('#pro_cout_annuel').val();

        if (pro_intitule == "" || Sce_code_service == "" ||
            Dev_code_devise == "" || pro_debut_periode == "" ||
            pro_fin_periode == "" || pro_cout_unitaire == "" ||
            pro_cout_mensuel == "" || pro_cout_trimestriel == "" ||
            pro_cout_semestriel == "" || pro_cout_annuel == "") {
            alert('Aucun champ ne doit être vide.');
            $('#pro_intitule').focus();
            return false;
        }
        var IDas_promotion = $('#IDas_promotion').val();
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
                IDas_promotion: IDas_promotion,
                pro_intitule: pro_intitule,
                Sce_code_service: Sce_code_service,
                Dev_code_devise: Dev_code_devise,
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
                alert('service mis à jour.');
                window.location.replace("/promotions");
            },
            error: function(data) {
                console.log(data);
            }
        });
    });

    // Supprimer
    $('.supprimer').click(function() {
        var rep = confirm("Voulez-vous supprimer cette promotion ?");
        if (rep == false) {
            return false;
        }
        var id = $(this).attr('id');
        $.ajax({
            type: "get",
            url: "/promotions-delete/" + id,
            dataType: "json",
            success: function(data) {
                alert('Promotion supprimée');
                window.location.replace("/promotions");
            },
            error: function(data) {
                console.log(data);
            }
        });

    }); */
});