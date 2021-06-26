$("#edit-question").toggle();
$('#changeImg').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
})

function reset() {
    $(".testAnswer1").hide()
    $(".testAnswer2").hide()
    $(".testAnswer3").hide()
    $(".testAnswer4").hide()
    $(".testAnswer1Edit").hide()
    $(".testAnswer2Edit").hide()
    $(".testAnswer3Edit").hide()
    $(".testAnswer4Edit").hide()
    $("#errorDescription").hide()
    $("#errorImage").hide()
}
reset()
function resetErrors() {
    $('#errorAnswer1').hide()
    $('#errorAnswer2').hide()
    $('#errorAnswer3').hide()
    $('#errorAnswer4').hide()
    $('#errorTestType').hide()
    $('#errorQuestion').hide()
    $('#correctAnswer').hide()
    $("#errorDescription").hide()
}
resetErrors()
$("#flexRadioDefault1").click(function () {
    reset()
    $(".testAnswer1").show()
    $(".testAnswer2").show()

});
$("#flexRadioDefault1Edit").click(function () {
    reset()
    $(".testAnswer1Edit").show()
    $(".testAnswer2Edit").show()
});
$("#flexRadioDefault2").click(function () {
    reset()
    $(".testAnswer1").show()
    $(".testAnswer2").show()
    $(".testAnswer3").show()
    $(".testAnswer4").show()

});
$("#flexRadioDefault2Edit").click(function () {
    reset()

    $(".testAnswer1Edit").show()
    $(".testAnswer2Edit").show()
    $(".testAnswer3Edit").show()
    $(".testAnswer4Edit").show()
});

jQuery(document).ready(function ($) {
    //*** CREATE
    $("#back-to-create").click(function (e) {
        reset()
        $("#create-question").show();
        $("#edit-question").hide();
    })
        $("body").on("click", ".open-edit", function (e) {
        $("#create-question").hide();
        $("#edit-question").show();
        var variable = $(this).val();
        $("#testQuestionEdit").val(variable)
        $("#editId").val($(this).attr("data-id"));
    })
    //*** EDIT
    $("#updateButton").click(function (e) {
        resetErrors()
        edit(e)
    })
    //*** ADD NEW QUESTION
    $("#btn-add").click(function (e) {
        resetErrors()
        add(e)
    });
    //*** change description
    $("#change-description-button").click(function () {
       changeDescripton();
    });
    //*** Image upload
    $("#change-image-button").click(function () {
        changeImage();
    });
});

