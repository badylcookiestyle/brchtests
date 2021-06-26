var k=0

function getChoosenAnswerEdit(){
    if (jQuery('#correctAnswer1Edit').is(':checked')) {
        return choosenAnswer = 1
    }
    if (jQuery('#correctAnswer2Edit').is(':checked')) {
        return choosenAnswer = 2
    }
    if (jQuery('#correctAnswer3Edit').is(':checked')) {
        return choosenAnswer = 3
    }
    if (jQuery('#correctAnswer4Edit').is(':checked')) {
        return choosenAnswer = 4
    }
    if (!choosenAnswer) {
        $('#errorTestType'.toString()).text("You have to choose correct answer")
    }
}
function getChoosenAnswer(){
    if (jQuery('#correctAnswer1').is(':checked')) {
        return choosenAnswer = 1
    }
    if (jQuery('#correctAnswer2').is(':checked')) {
        return choosenAnswer = 2
    }
    if (jQuery('#correctAnswer3').is(':checked')) {
        return choosenAnswer = 3
    }
    if (jQuery('#correctAnswer4').is(':checked')) {
        return choosenAnswer = 4
    }
    if (!choosenAnswer) {
        $('#errorTestType'.toString()).text("You have to choose correct answer")
    }
}
function drawQuestionErrors(question){
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
function drawQuestionGroup(question){
    for (i = 0; i < question.length; i++) {
        $('#currentQuestions').append("<div id='z"+i+"'class='border-top'>" +
            "<a href='delete/" + question[i].id + "'class='btn text-light btn-danger float-right mt-2'  >Delete</a>" +
            "<button  val='" + question[i].question + "' class='btn btn-info mt-2 mr-2 float-right open-edit' data-id='" + question[i].id + "'>Edit </button>" +
            "<h4 class='font-weight-bold'>question " + question[i].question + "</h4>" +
            " <h5 class='ml-2 text-muted' id='q1'>answer 1: " + question[i].first_answer + "</h5>" +
            " <h5 class='ml-2 text-muted' id='q2'>answer 2: " + question[i].second_answer + "</h5>"
        )
        if (question[i].question_type == "4_questions") {
            $('#currentQuestions').append(
                " <h5 class='ml-2 text-muted' id='q3' >answer 3: " + question[i].third_answer + "</h5>" +
                " <h5 class='ml-2 text-muted' id='q4'>answer 4: " + question[i].fourth_answer + "</h5>")
        }
        $('#currentQuestions').append("</div>")
        k++
    }
}
function markCorrectAnswer(question){
    for(i=0;i<question.length;i++){
        if(question[i].correct_answer==1){
            $( "#z"+i ).find( "#q1" ).removeClass("text-muted").css( "color", "#28a745" );
        }
        if(question[i].correct_answer==2){
            $( "#z"+i).find( "#q2" ).removeClass("text-muted").css( "color", "#28a745" );
        }
        if(question[i].correct_answer==3){
            $( "#z"+i ).find( "#q3" ).removeClass("text-muted").css( "color", "#28a745" );
        }
        if(question[i].correct_answer==4){
            $( "#z"+i ).find( "#q4" ).removeClass("text-muted").css( "color", "#28a745" );
        }
        k++
    }
}
function edit(e){
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
    var choosenAnswer = getChoosenAnswerEdit()

    var formData = {
        testIdEdit: currentId,
        questionIdEdit: jQuery('#editId').val(),
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
            var question = data.testData;
            k=1
            drawQuestionGroup(question)
            markCorrectAnswer(question)
        },
        error: function (data) {
            console.log(data);
            drawQuestionErrors(data)
        }
    });
}
function add(e){
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
    var choosenAnswer = getChoosenAnswer()
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
            var k=1
            $('#editForm')[0].reset()
            $('#currentQuestions').empty()
            reset()
            var question = data.testData;
            k=1
            drawQuestionGroup(question)
            markCorrectAnswer(question)
            console.log("a"+k)

            console.log("b"+k)
        },
        error: function (data) {
            console.log(data);
            drawQuestionErrors(data)
        }
    });
}
function changeDescripton(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    var formData = {
        descriptionTest: $("#new-decription-textarea").val(),
        testId: currentId
    }
    $.ajax({
        type: "POST",
        url: "changeDescription",
        data: formData,
        dataType: 'json',
        success: function (data) {
            console.log(data);

            var newDesc = $("#new-decription-textarea").val()
            $("#description-paragraph").empty()
            $("#description-paragraph").text(newDesc)


            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();

        },
        error: function (data) {
            console.log(data);
            $('#errorDescription'.toString()).text(data.responseJSON.errors.descriptionTest)
            $('#errorDescription'.toString()).toggle()
        }
    });
}
function changeImage(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    var fd = new FormData();
    var files = $('#image-input')[0].files[0];
    fd.append('file', files);
    fd.append('testId', currentId);

    //formData.append('file',$("#image-input").val())
    $.ajax({
        type: "POST",
        url: "changeImg",
        data: fd,

        contentType: false,
        processData: false,

        success: function (data) {
            console.log(data);


        },
        error: function (data) {
            console.log(data);
            $('#errorImage'.toString()).text(data.responseJSON.errors.file)
            $('#errorImage'.toString()).toggle()
        }
    });
}
