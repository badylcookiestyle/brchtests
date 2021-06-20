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
            $("body").find(".sc").remove()
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
            $("#errorComment").hide()
            $("#c" + currentComment).find('h3').html($("#editCommentArea").val());
            $("#editCommentArea").val("")
            $("#editComment").hide();
            $("#addComment").show();
        },
        error: function(data) {
            $('#errorComment'.toString()).empty()
            $('#errorComment'.toString()).text(data.responseJSON.errors.commentArea)
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
    }
    $.ajax({
        type: "POST",
        url: "addComment",
        data: formData,
        dataType: 'json',
        success: function(data) {
            $("#errorComment").hide()
            $("#commentArea").val("")
            $("#comments-list").prepend("<div id='c" + data.commentId + "'><h3>" + data.contents + "</h3><h6>" + data.created_at + "</h6><button class='btn btn-sm btn-outline-info py-0 mr-2' style='font-size: 0.8em;' id='editCommentButton' value='" + data.contents + "' data-id='" + data.commentId + "'>Edit </button><button class='btn btn-sm btn-outline-danger py-0' style='font-size: 0.8em;' id='deleteComment' data-id='" + data.commentId + "'>Delete</button> <button class='btn btn-sm btn-outline-dark py-0' style='font-size: 0.8em;' id='replyButton' value='" + data.contents + "' data-id='" + data.commentId + "'>Reply </button></div>")
        },
        error: function(data) {
            $('#errorComment'.toString()).empty()
            if (!data.responseJSON.message) {
                $('#errorComment'.toString()).text(data.responseJSON.errors.commentArea)
            } else {
                if ($("#commentArea").val() != "") {
                    $('#errorComment'.toString()).text("you must be logged if u wanna add a comment");
                } else {
                    $('#errorComment'.toString()).text("you have to write somethin");
                }
            }
            $('#errorComment'.toString()).toggle()
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
            $(".replyFormEdit").remove();
        },
        error: function(data) {
        }
    });
}
//subcomments
function deleteSubComment() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    var id = $(this).data("id");
    var url = "subComment/delete/" + id;
    $.ajax({
        url: url,
        type: 'delete',
        data: {
            id: id
        },
        success: function(data) {
            $("body").find("#sc" + id).remove()
            //$("#c" + id).remove();
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
            $('.replyForm').remove()
            getSubComment(id)
        },
    });
    $('.replyForm').remove()
}
