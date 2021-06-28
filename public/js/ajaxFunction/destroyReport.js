
    $("body").on("click", "#deleteButton", function (e) {

        var id=$(this).data('id')
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax(
            {
                url: "reportsList/delete/"+id,
                type: 'delete',
                dataType: "JSON",
                data: {
                    "id":id
                },
                success: function (data)
                {


                    $("#r"+id).hide()
                    $("#r"+id).remove()

                },

            });
    });

