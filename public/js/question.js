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
}

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
$("#change-description-button").click(function () {

});
jQuery(document).ready(function ($) {
    resetErrors()
    // CREATE
    $("#back-to-create").click(function (e) {
        reset()
        $("#create-question").show();
        $("#edit-question").hide();
        console.log("I have been clicked")
    })
    $(".open-edit").click(function (e) {
        $("#create-question").hide();
        console.log("brch")
        console.log($(this).attr("data-id"))
        $("#edit-question").show();
        var variable=$(this).val();
        $("#testQuestionEdit").val(variable)
        $("#editId").val($(this).attr("data-id"));
    })
    //******************************************************************************* EDIT
    $("#updateButton").click(function (e) {
        resetErrors()
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var input3 = jQuery('#testAnswer3Edit').val();
        var input4 = jQuery('#testAnswer4Edit').val();
        var type = "4_questions";
        if (jQuery('#flexRadioDefault1Edit').is(':checked')) {
            type = "yes_or_no"
            input3 = "--"
            input4 = "--"
        }
        var choosenAnswer = 0
        if (jQuery('#correctAnswer1Edit').is(':checked')) {
            choosenAnswer = 1
        }
        if (jQuery('#correctAnswer2Edit').is(':checked')) {
            choosenAnswer = 2
        }
        if (jQuery('#correctAnswer3Edit').is(':checked')) {
            choosenAnswer = 3
        }
        if (jQuery('#correctAnswer4Edit').is(':checked')) {
            choosenAnswer = 4
        }
        if (!choosenAnswer) {
            $('#errorTestType'.toString()).text("You have to choose correct answer")
        }
        var formData = {
            testIdEdit: currentId,
            questionIdEdit:jQuery('#editId').val(),
            testQuestionEdit: jQuery('#testQuestionEdit').val(),
            flexRadioDefaultEdit: type,
            correct_answerEdit: choosenAnswer,
            testAnswer1Edit: jQuery('#testAnswer1Edit').val(),
            testAnswer2Edit: jQuery('#testAnswer2Edit').val(),
            testAnswer3Edit: input3,
            testAnswer4Edit: input4,
        };
        var state = jQuery('#updateButton').val();
        var type = "POST";

        $.ajax({
            type: type,
            url: "update",
            data: formData,
            dataType: 'json',
            success: function (data) {
                $('#editForm')[0].reset()
                $('#currentQuestions').empty()
                reset()
                console.log(data)
                var question = data.testData;
                for (i = 0; i < question.length; i++) {
                    $('#currentQuestions').append("<div class='border-top'>" +
                        "<a href='delete/" + question[i].id + "'class='btn text-light btn-danger float-right mt-2'  >Delete</a>" +
                        "<button  val='"+question[i].question+"' class='btn btn-info mt-2 mr-2 float-right open-edit' data-id='"+question[i].id+"'>Edit </button>"+

                        "<h4 class='font-weight-bold'>question " + question[i].question + "</h4>" +
                        " <h5 class='ml-2 text-muted'>answer 1: " + question[i].first_answer + "</h5>" +
                        " <h5 class='ml-2 text-muted'>answer 2: " + question[i].second_answer + "</h5>"
                    )
                    if (question[i].question_type == "4_questions") {
                        $('#currentQuestions').append(
                            " <h5 class='ml-2 text-muted'>answer 3: " + question[i].third_answer + "</h5>" +
                            " <h5 class='ml-2 text-muted'>answer 4: " + question[i].fourth_answer + "</h5>")
                    }
                    $('#currentQuestions').append("</div>")
                }
            },
            error: function (data) {
                console.log(data);
                if (data.responseJSON.errors.testAnswer1Edit) {
                    $('#errorAnswer1'.toString()).text(data.responseJSON.errors.testAnswer1Edit)
                    $('#errorAnswer1'.toString()).toggle()
                }
                if (data.responseJSON.errors.testAnswer2Edit) {
                    $('#errorAnswer2'.toString()).text(data.responseJSON.errors.testAnswer2Edit)
                    $('#errorAnswer2'.toString()).toggle()
                }
                if (data.responseJSON.errors.testAnswer3Edit) {
                    $('#errorAnswer3'.toString()).text(data.responseJSON.errors.testAnswer3Edit)
                    $('#errorAnswer3'.toString()).toggle()
                }
                if (data.responseJSON.errors.testAnswer4Edit) {
                    $('#errorAnswer4'.toString()).text(data.responseJSON.errors.testAnswer4Edit)
                    $('#errorAnswer4'.toString()).toggle()
                }
                if (data.responseJSON.errors.testQuestionEdit) {
                    $('#errorQuestion'.toString()).text(data.responseJSON.errors.testQuestionEdit)
                    $('#errorQuestion'.toString()).toggle()
                }
                if (data.responseJSON.errors.correct_answerEdit) {
                    $('#errorTestType'.toString()).text(data.responseJSON.errors.correct_answerEdit)
                    $('#errorTestType'.toString()).toggle()
                }
            }
        });
    })
    //**************************************************************************** ADD
    $("#btn-add").click(function (e) {
        resetErrors()
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var input3 = jQuery('#testAnswer3').val();
        var input4 = jQuery('#testAnswer4').val();
        var type = "4_questions";
        if (jQuery('#flexRadioDefault1').is(':checked')) {
            type = "yes_or_no"
            input3 = "--"
            input4 = "--"
        }
        var choosenAnswer = 0
        if (jQuery('#correctAnswer1').is(':checked')) {
            choosenAnswer = 1
        }
        if (jQuery('#correctAnswer2').is(':checked')) {
            choosenAnswer = 2
        }
        if (jQuery('#correctAnswer3').is(':checked')) {
            choosenAnswer = 3
        }
        if (jQuery('#correctAnswer4').is(':checked')) {
            choosenAnswer = 4
        }
        if (!choosenAnswer) {
            $('#errorTestType'.toString()).text("You have to choose correct answer")
        }
        var formData = {
            testId: currentId,
            testQuestion: jQuery('#testQuestion').val(),
            flexRadioDefault: type,
            correct_answer: choosenAnswer,
            testAnswer1: jQuery('#testAnswer1').val(),
            testAnswer2: jQuery('#testAnswer2').val(),
            testAnswer3: input3,
            testAnswer4: input4,
        };
        var state = jQuery('#btn-add').val();
        var type = "POST";

        $.ajax({
            type: type,
            url: "store",
            data: formData,
            dataType: 'json',
            success: function (data) {
                $('#justAForm')[0].reset()
                $('#currentQuestions').empty()
                reset()
                console.log(data.testData)
                var question = data.testData;
                for (i = 0; i < question.length; i++) {
                    $('#currentQuestions').append("<div class='border-top'>" +
                        "<a href='delete/" + question[i].id + "'class='btn text-light btn-danger float-right mt-2'  >Delete</a>" +
                        "<button  val='"+question[i].question+"' class='btn btn-info mt-2 mr-2 float-right open-edit' data-id='"+question[i].id+"'>Edit </button>"+
                      //  "<button val='"+question[i].question+"' id='' class='btn btn-info mt-2 mr-2 float-right open-edit'data-id='"+question[i].id+"'>Edit </button>" +
                        "<h4 class='font-weight-bold'>question " + question[i].question + "</h4>" +
                        " <h5 class='ml-2 text-muted'>answer 1: " + question[i].first_answer + "</h5>" +
                        " <h5 class='ml-2 text-muted'>answer 2: " + question[i].second_answer + "</h5>"
                    )
                    if (question[i].question_type == "4_questions") {
                        $('#currentQuestions').append(
                            " <h5 class='ml-2 text-muted'>answer 3: " + question[i].third_answer + "</h5>" +
                            " <h5 class='ml-2 text-muted'>answer 4: " + question[i].fourth_answer + "</h5>")
                    }
                    $('#currentQuestions').append("</div>")
                }
            },
            error: function (data) {
                console.log(data);
                if (data.responseJSON.errors.testAnswer1) {
                    $('#errorAnswer1'.toString()).text(data.responseJSON.errors.testAnswer1)
                    $('#errorAnswer1'.toString()).toggle()
                }
                if (data.responseJSON.errors.testAnswer2) {
                    $('#errorAnswer2'.toString()).text(data.responseJSON.errors.testAnswer2)
                    $('#errorAnswer2'.toString()).toggle()
                }
                if (data.responseJSON.errors.testAnswer3) {
                    $('#errorAnswer3'.toString()).text(data.responseJSON.errors.testAnswer3)
                    $('#errorAnswer3'.toString()).toggle()
                }
                if (data.responseJSON.errors.testAnswer4) {
                    $('#errorAnswer4'.toString()).text(data.responseJSON.errors.testAnswer4)
                    $('#errorAnswer4'.toString()).toggle()
                }
                if (data.responseJSON.errors.testQuestion) {
                    $('#errorQuestion'.toString()).text(data.responseJSON.errors.testQuestion)
                    $('#errorQuestion'.toString()).toggle()
                }
                if (data.responseJSON.errors.correct_answer) {
                    $('#errorTestType'.toString()).text(data.responseJSON.errors.correct_answer)
                    $('#errorTestType'.toString()).toggle()
                }
            }
        });
    });
});
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('#upload-image-form').submit(function(e) {
    e.preventDefault();
    let formData = new FormData(this);
    $('#image-input-error').text('');

    $.ajax({
        type:'POST',
        url: 'changeImg',
        data: formData,
        contentType: false,
        processData: false,
        success: (response) => {
            console.log(response)
            if (response) {
                this.reset();

            }
        },
        error: function(response){
            console.log(response);
            $('#image-input-error').text(response.responseJSON.errors.file);
        }
    });
});
