var currentComment = 0;
var currentSubComment = 0;

$(document).ready(function () {
    //reply
    $("body").on("click", "#replyButton", function (e) {
        var id = $(this).data("id");
        $('.replyForm').fadeOut(100)
        $('.replyForm').remove()
        $("body").find(".sc").fadeOut(100)
        $("body").find(".sc").remove()
        $("#c" + id).append(" <div class='form-group d-flex replyForm'> <label for='subCommentArea' class='m-2'>reply</label> <textarea class='form-control m-2' id='subCommentArea' rows='3'></textarea><button id='replySendButton' class='btn btn-outline-success' data-id='" + id + "'>send</button></div> ")
        $("#c"+id).hide()
        $("#c"+id).fadeIn(100)
    })
    //get subcomments
    $("body").on("click", "#expandReplies", function (e) {
        $('.replyForm').fadeOut(100)
        $('.replyForm').remove()
        var id = $(this).data("id")
        getSubComment(id)
    })
    //send subcomment
    $("body").on("click", "#replySendButton", function (e) {
        $('.replyForm').fadeOut(100)
        $("body").find(".sc").remove()
        var content = $("#subCommentArea").val()
        var id = $(this).data("id")
        console.log("id" + id + " content " + content)
        sendReply(id, content)
    })

    //delete comment
    $("body").on("click", "#deleteComment", function (e) {
        var id = $(this).data("id");
        var url = "comment/delete/" + id;
        deleteComment(id, url)
    })
    //delete subcomment
    $("body").on("click", "#deleteSubComment", function (e) {
        var id = $(this).data("id");
        var url = "subComment/delete/" + id;
        deleteSubComment(id,url)
    })
    //edit subcomment
    $("body").on("click", "#editSubCommentButton", function (e) {
        $(".replyFormEdit").fadeOut(100)
        $(".replyFormEdit").remove()
        id = $(this).data("id")
        currentSubComment = id
        $("#sc" + id).append(" <div class='form-group d-flex replyFormEdit'> <label for='subCommentAreaEdit' class='m-2'>edit</label> <textarea class='form-control m-2' id='subCommentAreaEdit' rows='3'></textarea><button id='replySendButtonEdit' class='btn btn-outline-success' data-id='" + id + "'>send</button></div> ")
    })
    //edit comment
    $("body").on("click", "#editCommentButton", function (e) {
        $("#editComment").fadeIn(100);
        $("#addComment").fadeOut(100);
        $("#editCommentArea").val($(this).val())
        currentComment = $(this).data("id")

    })
    $("#commentBack").click(function () {
        $("#editComment").fadeOut(100);
        $("#addComment").fadeIn(100);
    })
    $("#sendForm").click(function () {
        editComment();
    })
    //editing form
    $("#sendEditForm").click(function () {
        sendEditComment()
    })
    //edit subcomment
    $("body").on("click", "#replySendButtonEdit", function (e) {
        editSubComment()
    })
})
