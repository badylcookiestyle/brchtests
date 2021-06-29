$(".description").hide()
$( document ).ready(function() {
    $("body").on("click", "#reasonButton", function (e) {
        var id = $(this).data("id");
        $(this).removeClass("btn-outline-info")
        $(this).addClass("btn-outline-dark")
        $(".description").fadeOut(100)
        $("#d"+id).fadeIn(200)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        var formData = {
            reportId: id,
        }
        $.ajax({
            type: "POST",
            url: "read",
            data: formData,
            dataType: 'json',

        });
    })
});
