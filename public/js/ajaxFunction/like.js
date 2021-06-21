
$("body").on("click", "#likeButton", function (e) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    var formData = {
       testId: testId
    }
    $.ajax({
        type: "POST",
        url: "like",
        data: formData,
        dataType: 'json',
        success: function(data) {
           if(data.success=="increment"){
                $("#likeAmount").text(parseInt($("#likeAmount").text())+1)
               $("#likeButton").removeClass("btn-outline-dark")
               $("#likeButton").addClass("btn-outline-danger")
           }
            if(data.success=="decrement"){
                $("#likeAmount").text(parseInt($("#likeAmount").text())-1)
                $("#likeButton").removeClass("btn-outline-danger")
                $("#likeButton").addClass("btn-outline-dark")
            }
        },
        error: function(data) {
            console.log(data)
        }
    });
})
