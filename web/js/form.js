$(document).ready(function () {

    $("#form-user").submit(function (e) {
        e.preventDefault();
        var form = $(this);

        var btn = $(":submit", form);

        if (!btn.is("[load]")) {
            var prevHtml = btn.html();
            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: form.serialize(),
                dataType: "json",
                beforeSend: function () {
                    btn.attr('load', true);
                    btn.html('Loading');
                },
                success: function (msg) {
                    if (msg.status == 'OK') {
                        $("#form_user").empty();
                        $("#feedback").empty();
                        $(msg.template).hide().appendTo($("#form_user")).fadeIn(1000);
                    } else {
                        $("#feedback").html(msg.template);
                    }
                },
                error: function () {
                    alert("qualcosa è andato storto");
                },
                complete: function () {
                    btn.html(prevHtml);
                    btn.removeAttr('load');
                }
            });
        }


    });

});

