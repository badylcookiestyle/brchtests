var currentComment = 0;
var currentSubComment = 0;

$(document).ready(function () {
    //reply
    $("body").on("click", "#replyButton", function (e) {
        var id = $(this).data("id");
        $('.replyForm').remove()
        $("body").find(".sc").remove()
        $("#c" + id).append(" <div class='form-group d-flex replyForm'> <label for='subCommentArea' class='m-2'>reply</label> <textarea class='form-control m-2' id='subCommentArea' rows='3'></textarea><button id='replySendButton' class='btn btn-outline-success' data-id='" + id + "'>send</button></div> ")
    })
    //get subcomments
    $("body").on("click", "#expandReplies", function (e) {
        $('.replyForm').remove()
        var id = $(this).data("id")
        getSubComment(id)
    })
    //send subcomment
    $("body").on("click", "#replySendButton", function (e) {
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
        deleteSubComment()
    })
    //edit subcomment
    $("body").on("click", "#editSubCommentButton", function (e) {
        $(".replyFormEdit").remove()
        id = $(this).data("id")
        currentSubComment = id
        $("#sc" + id).append(" <div class='form-group d-flex replyFormEdit'> <label for='subCommentAreaEdit' class='m-2'>edit</label> <textarea class='form-control m-2' id='subCommentAreaEdit' rows='3'></textarea><button id='replySendButtonEdit' class='btn btn-outline-success' data-id='" + id + "'>send</button></div> ")
    })
    //edit comment
    $("body").on("click", "#editCommentButton", function (e) {
        $("#editComment").show();
        $("#addComment").hide();
        $("#editCommentArea").val($(this).val())
        currentComment = $(this).data("id")
    })
    $("#commentBack").click(function () {
        $("#editComment").hide();
        $("#addComment").show();
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
