$(document).ready(function() {
    $("#btn").click(function (e) {
        $("#result").html($(this).attr('data-profilo'));
    });
});