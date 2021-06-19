var currentComment=0;
$("#errorComment").hide()
$("#editComment").hide();
$(document).ready(function () {
    //reply

    $("body").on("click", "#replyButton", function (e) {
        var id = $(this).data("id");
        console.log("kek"+id)
        $('#replyForm').remove()

        $("#c"+id).append(" <div class='form-group d-flex replyForm'> <label for='subCommentArea' class='m-2'>reply</label> <textarea class='form-control m-2' id='subCommentArea' rows='3'></textarea> <button id='replySendButton' class='btn btn-outline-success' data-id='"+id+"'>send</button>")
    })
    $("body").on("click", "#expandReplies", function (e) {

        var id=$(this).data("id")
        console.log(id)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        var formData = {
            commentId:id,
        }
        $.ajax({
            type: "POST",
            url: "getSubComments",
            data: formData,
            dataType: 'json',
            success: function (data) {

                console.log(data.subComments);
                for(i=0;i<3;i++){
                    $("#c"+data.subComments[i].comment_id).append("<div class='border-bottom ml-3'><h3>"+data.subComments[i].contents+"</h3><h6>"+data.subComments[i].created_at+"</h6></div>")
                }


            },
            error: function (data) {

                console.log(data);

            }
        });
        // $('#replyForm').remove()
    })
    //send subcomment
    $("body").on("click", "#replySendButton", function (e) {
        var content=$("#subCommentArea").val()
        var id=$(this).data("id")
        console.log("id"+id+" content "+content)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }

        });
        var formData = {
            commentArea:content,
            commentId:id

        }
        $.ajax({
            type: "POST",
            url: "addSubComment",
            data: formData,
            dataType: 'json',
            success: function (data) {
                //$("#errorComment").hide()
                console.log(data);
                //$("#commentArea").val("")
                //$("#comments-list").prepend("<div id='c" + data.commentId + "'><h3>" + data.contents + "</h3><h6>" + data.created_at + "</h6><button class='btn btn-sm btn-outline-info py-0 mr-2' style='font-size: 0.8em;'id='editCommentButton' value='"+data.contents+"' data-id='"+data.commentId+"'>Edit </button><button class='btn btn-sm btn-outline-danger py-0' style='font-size: 0.8em;' id='deleteComment' data-id='" + data.commentId + "'>Delete</button></div>")
                $('#replyForm').remove()

            },
            error: function (data) {
                //console.log(data.responseJSON.message);
                console.log(data);

            }
        });
       // $('#replyForm').remove()
    })
    //  $(body)("#deleteComment").click(function () {
    $("body").on("click", "#deleteComment", function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        var id = $(this).data("id");
        var url = "comment/delete/" + id;
        $.ajax(
            {
                url: url,
                type: 'delete',
                data: {
                    id: id
                },
                success: function (data) {
                    $("#c" + id).remove();
                }
            });
    })
    $("body").on("click", "#editCommentButton", function (e) {
        $("#editComment").show();
        $("#addComment").hide();
        $("#editCommentArea").val($(this).val())
        currentComment=$(this).data("id")
    })
    $("#commentBack").click(function(){
        $("#editComment").hide();
        $("#addComment").show();
    })
    $("#sendForm").click(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        var formData = {
            commentArea: $("#commentArea").val(),
            testId: testId

    }
        $.ajax({
            type: "POST",
            url: "addComment",
            data: formData,
            dataType: 'json',
            success: function (data) {
                $("#errorComment").hide()
                console.log(data);
                $("#commentArea").val("")
                $("#comments-list").prepend("<div id='c" + data.commentId + "'><h3>" + data.contents + "</h3><h6>" + data.created_at + "</h6><button class='btn btn-sm btn-outline-info py-0 mr-2' style='font-size: 0.8em;'id='editCommentButton' value='"+data.contents+"' data-id='"+data.commentId+"'>Edit </button><button class='btn btn-sm btn-outline-danger py-0' style='font-size: 0.8em;' id='deleteComment' data-id='" + data.commentId + "'>Delete</button></div>")


            },
            error: function (data) {
                console.log(data.responseJSON.message);
                console.log(data);
                $('#errorComment'.toString()).empty()
                if (!data.responseJSON.message) {
                    $('#errorComment'.toString()).text(data.responseJSON.errors.commentArea)
                } else {
                    $('#errorComment'.toString()).text("you must be logged if u wanna add a comment");
                }
                $('#errorComment'.toString()).toggle()
            }
        });
    })
    //editing form
    $("#sendEditForm").click(function () {
        console.log("leeel")
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        var formData = {
            commentArea: $("#editCommentArea").val(),
            commentId: currentComment

        }
        $.ajax({
            type: "POST",
            url: "editComment",
            data: formData,
            dataType: 'json',
            success: function (data) {

                $("#errorComment").hide()
                $("#c"+currentComment).find('h3').html($("#editCommentArea").val());
                $("#editCommentArea").val("")
                $("#editComment").hide();
                $("#addComment").show();

            },
            error: function (data) {

                console.log(data);
                $('#errorComment'.toString()).empty()

                $('#errorComment'.toString()).text(data.responseJSON.errors.commentArea)

            }
        });
    })
})