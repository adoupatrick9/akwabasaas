$(document).ready(function() {

    $('.chargeM').hide();

    $('#addRepresentant').submit(function(e) {
        e.preventDefault();
        var _token = $('meta[name="csrf-token"]').attr('content');
        var ap_matricule_pers = $('#ap_matricule_pers option:selected').val();
        var matricule = $('#matricule').val();
        var IDpartenaire = $('#IDpartenaire').val();
        if (ap_matricule_pers == "") {
            alert('Veuillez selectionner le représentant.');
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
                ap_matricule_pers: ap_matricule_pers,
            },
            dataType: 'json',
            success: function(response) {
                if (response.status == 302) {
                    alert('Représentant non enregistré');
                    return false;
                }
                alert("Le représentant a bien été enregistré.");
                window.location.replace('utilisateurs-representant/' + IDpartenaire + '/partenaire');
            },
            error: function(response) {
                console.log(response);
            }
        });
    });

});