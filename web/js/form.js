$(document).ready(function () {

    $("#form-user").submit(function (e) {
        e.preventDefault();
        var form = $(this);
        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: form.serialize(),
            success: function (msg) {
                if(msg.status == 'OK'){
                    $("#feedback").html(msg.template);
                }else{
                    $("#feedback").html(msg.template);
                }
            },
            error: function () {
                //error
            }
        });

    });

});

