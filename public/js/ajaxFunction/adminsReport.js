$("#AdminWarningButton").click(function(){
    var title=$("#reportOrWarningTitle").val()
    var description=$("#reportOrWarningDescription").val()
    var action
    if (jQuery('#warningOnly').is(':checked')) {
        action="warningOnly";
    }
    if(jQuery("#warningWithDelete").is(':checked')){
        action="warningWithDelete";
    }
    if (jQuery('#correctAnswer4Edit').is(':checked')) {
        return choosenAnswer = 4
    }
    console.log(action)
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    var formData = {
        title: title,
        description: description,
        action: action,
        testId:testId
    }
    $.ajax({
        type: "POST",
        url: "warningOrDelete",
        data: formData,
        dataType: 'json',
        error: function (data) {
            console.log(data);
            drawQuestionErrors(data)
        }
    });

})

$("#reportButton").click(function(){
    var title=$("#reportTitle").val()
    var description=$("#reportDescription").val()
    var action="reportOnly";


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    var formData = {
        title: title,
        description: description,
        action: action,
        testId:testId
    }
    $.ajax({
        type: "POST",
        url: "warningOrDelete",
        data: formData,
        dataType: 'json',
        success: function (data) {
            console.log(data);
        },
        error: function (data) {
            console.log(data);

        }
    })

})

