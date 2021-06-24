//Test like
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
        url: "testLike",
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
//Comment like
$("body").on("click", "#commentLikeButton", function (e) {
    var justAnId=$(this).data("id")
    console.log("b"+justAnId)
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    var formData = {
        commentId: justAnId
    }
    $.ajax({
        type: "POST",
        url: "commentLike",
        data: formData,
        dataType: 'json',
        success: function(data) {
            console.log("d"+data.commentId)
            console.log(justAnId)

            if(data.success=="increment"){
                $(".lkt"+justAnId).text(parseInt($("#commentLikeAmount"+justAnId).text())+1)
                $(".lk"+justAnId).removeClass("btn-outline-dark")
                $(".lk"+justAnId).addClass("btn-outline-danger")
            }
            if(data.success=="decrement"){
                $(".lkt"+justAnId).text(parseInt($("#commentLikeAmount"+justAnId).text())-1)
                $(".lk"+justAnId).removeClass("btn-outline-danger")
                $(".lk"+justAnId).addClass("btn-outline-dark")
            }
        },
        error: function(data) {
            console.log(data)
        }
    });
})
