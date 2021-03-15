$(document).ready(function() {
    // Ajouter une devise
    $('#storeDevise').submit(function(e) {
        e.preventDefault();
        $('#msg').removeClass('alert alert-success').text('');
        var _token = $('input[name="_token"]').val();
        var intitule = $('input[name="Dev_intitule_devise"]').val();
        if (intitule == "") {
            alert('Le nom de la devise ne doit pas être vide.');
            $('input[name="Dev_intitule_devise"]').focus();
            return false;
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': _token,
            }
        });
        $.ajax({
            type: "post",
            url: "/devises-create",
            data: {
                Dev_intitule_devise: intitule
            },
            dataType: 'html',
            success: function(response) {
                $('input[name="Dev_intitule_devise"]').val('');
                $('#msg').addClass('alert alert-success').text('La devise a bien été enregistré.');
                $('#ajoutDevise').append(response);
            },
            error: function(response) {
                console.log(response);
            }
        });
    });

    //Modifier une devise
    $('#modifier').click(function(e){
        e.preventDefault();
        var id = $("#modifier:first-child").attr('href').val();
        alert(id);
    });
});
