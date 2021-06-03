function reset() {
    $(".testAnswer1").hide()
    $(".testAnswer2").hide()
    $(".testAnswer3").hide()
    $(".testAnswer4").hide()

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
$("#flexRadioDefault1").click(function() {
    reset()
    $(".testAnswer1").show()
    $(".testAnswer2").show()
});
$("#flexRadioDefault2").click(function() {
    reset()
    $(".testAnswer1").show()
    $(".testAnswer2").show()
    $(".testAnswer3").show()
    $(".testAnswer4").show()
});
jQuery(document).ready(function($) {
    resetErrors()

    // CREATE
    $("#btn-add").click(function(e) {
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
        var choosenAnswer=0
        if (jQuery('#correctAnswer1').is(':checked')) {
            choosenAnswer = 1}
        if (jQuery('#correctAnswer2').is(':checked')) {
            choosenAnswer = 2}
        if (jQuery('#correctAnswer3').is(':checked')) {
            choosenAnswer = 3}
        if (jQuery('#correctAnswer4').is(':checked')) {
            choosenAnswer = 4}
        if(!choosenAnswer){
            $('#errorTestType'.toString()).text("You have to choose correct answer")
        }
        var formData = {
            testId: currentId,
            testQuestion: jQuery('#testQuestion').val(),
            flexRadioDefault: type,
            correct_answer:choosenAnswer,
            testAnswer1: jQuery('#testAnswer1').val(),
            testAnswer2: jQuery('#testAnswer2').val(),
            testAnswer3: input3,
            testAnswer4: input4,
        };
        var state = jQuery('#btn-add').val();
        var type = "POST";
        var ajaxurl = 'question';
        $.ajax({
            type: type,
            url: "{{ url('question')}}",
            data: formData,
            dataType: 'json',
            success: function(data) {
                $('#justAForm')[0].reset()
                $('#currentQuestions').empty()
                reset()
                console.log(data.testData)
                var question = data.testData;
                for (i = 0; i < question.length; i++) {
                    $('#currentQuestions').append("<div class='border-top'>" + "<h4>question " + question[i].question + "</h4>" +
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
                error: function(data) {
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
