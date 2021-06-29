$("#errorComment").hide()
$("#editComment").hide();

//comments
function deleteComment(id, url) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: url,
        type: 'delete',
        data: {
            id: id
        },
        success: function(data) {
            $("body").find(".sc").fadeOut(100)
            $("body").find(".sc").remove()

            $("#c" + id).fadeOut(100);
            $("#c" + id).remove();
        }
    });
}

function sendEditComment() {
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
        success: function(data) {
            $("#errorComment").fadeOut(100)
            $("#c" + currentComment).find('h3').html($("#editCommentArea").val());
            $("#editCommentArea").val("")
            $("#editComment").fadeOut(100);
            $("#addComment").fadeIn(100);
        },
        error: function(data) {
            $("#errorComment").fadeIn(100)
            $('#errorComment'.toString()).empty()

            if (!data.responseJSON.message) {
                $('#errorComment'.toString()).text(data.responseJSON.errors.commentArea)
            } else {
                if ($("#editCommentArea").val() != "") {
                   if($("#editCommentArea").val().length<250) {
                       $('#errorComment'.toString()).text("you must be logged if u wanna edit a comment");
                   }
                   else{
                       $('#errorComment'.toString()).text("your comment is too long");
                   }
                   } else {
                    $('#errorComment'.toString()).text("you have to write somethin");
                }
            }
        }
    });
}

function editComment() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    var formData = {
        commentArea: $("#commentArea").val(),
        testId: testId
    };
    $.ajax({
        type: "POST",
        url: "addComment",
        data: formData,
        dataType: 'json',
        success: function(data) {

            $("#errorComment").fadeOut(100)
            $("#commentArea").val("")
            $("#comments-list").prepend("<div id='c" + data.commentId + "'><h3>" + data.contents + "</h3><h6>" + data.created_at + "</h6><button class='btn btn-sm btn-outline-info py-0 mr-2' style='font-size: 0.8em;' id='editCommentButton' value='" + data.contents + "' data-id='" + data.commentId + "'>Edit </button><button class='btn btn-sm btn-outline-danger py-0' style='font-size: 0.8em;' id='deleteComment' data-id='" + data.commentId + "'>Delete</button> <button class='btn btn-sm btn-outline-dark py-0' style='font-size: 0.8em;' id='replyButton' value='" + data.contents + "' data-id='" + data.commentId + "'>Reply </button><button id='commentLikeButton' class='btn ml-1 btn-outline-dark lk"+data.commentId+"' data-id='"+data.commentId+"'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor'" +
                "class='bi bi-heart' viewBox='0 0 16 16'>" +
                "<path d='m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z'/>\n" +
                "</svg></button><span class='ml-3 lkt"+data.commentId+"' id='commentLikeAmount"+data.commentId+"'style='font-size:1.2em'>0</span> </div>")
            $('#c'+data.commentId).fadeOut(100)
            $('#c'+data.commentId).fadeIn(100)
        },
        error: function(data) {

            $("#errorComment").fadeIn(100)
            $('#errorComment'.toString()).empty()
            if (!data.responseJSON.message) {
                $('#errorComment'.toString()).text(data.responseJSON.errors.commentArea)
            } else {
                if ($("#commentArea").val() != "") {
                    if($("#commentArea").val().length<250) {
                        $('#errorComment'.toString()).text("you must be logged if u wanna edit a comment");
                    }
                    else{
                        $('#errorComment'.toString()).text("your comment is too long");
                    }
                } else {
                    $('#errorComment'.toString()).text("you have to write somethin");
                }
            }

        }
    });
}
function editSubComment() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    var formData = {
        commentArea: $("#subCommentAreaEdit").val(),
        id: currentSubComment
    }
    $.ajax({
        type: "POST",
        url: "editSubComment",
        data: formData,
        dataType: 'json',
        success: function(data) {
            $("#sc" + currentSubComment).find('h3').html($("#subCommentAreaEdit").val());
            $(".replyFormEdit").fadeOut(100);
            $(".replyFormEdit").remove();
        },
        error: function(data) {
        }
    });
}
//subcomments
function deleteSubComment(id,url) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: url,
        type: 'delete',
        data: {
            id: id
        },
        success: function(data) {
            $("body").find("#sc" + id).fadeOut(100)
            $("body").find("#sc" + id).remove()

        }
    });
}

function getSubComment(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    var formData = {
        commentId: id,
    }
    $.ajax({
        type: "POST",
        url: "getSubComments",
        data: formData,
        dataType: 'json',
        success: function(data) {
            $("body").find(".sc").fadeOut(100)
            $("body").find(".sc").remove()
            for (i = 0; i < data.subComments.length; i++) {
                $("#c" + data.subComments[i].comment_id).append("<div id='sc" + data.subComments[i].id + "'class='border-bottom ml-3 sc' ><h3>" + data.subComments[i].contents + "</h3><h6>" + data.subComments[i].created_at + "</h6></div>")
                if (userId == data.subComments[i].user_id) {
                    $("#sc" + data.subComments[i].id).append("<button class='btn btn-outline-danger btn-sm' data-id='" + data.subComments[i].id + "' id='deleteSubComment'>Delete</button><button class='btn btn-sm ml-2 btn-outline-info' style='font-size: 0.8em;' id='editSubCommentButton' data-id='" + data.subComments[i].id + "'>Edit</button>")
                }

            }
        },
    });
}
function sendReply(id, content) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    var formData = {
        commentArea: content,
        commentId: id
    }
    $.ajax({
        type: "POST",
        url: "addSubComment",
        data: formData,
        dataType: 'json',
        success: function(data) {
            $('.replyForm').fadeOut(100)
            $('.replyForm').remove()
            getSubComment(id)
        },
    });
    $('.replyForm').fadeOut(100)
    $('.replyForm').remove()
}
