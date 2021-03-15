$("#FormLogin").submit(function(event) {
    // Stop form from submitting normally
    event.preventDefault();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({

        type: "post",
        dataType: 'json',
        url: $(this).attr('action'),
        success: function(result){
           alert("ok");
        },
        error: function (data) {
             $.each(data.responseJSON.errors, function (i, error) {
                        $('form')
                            .find('[id="' + i + '"]')
                            .addClass('has-error')
                            .next()
                            .append(error[0]);
                    });
        },

    });

});

/*
 */
