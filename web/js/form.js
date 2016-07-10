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
                    $("#feedback").html(msg.msg);
                }else{
                    $("#feedback").html(msg.errors);
                }
            },
            error: function () {
                //error
            }
        });

    });

});

