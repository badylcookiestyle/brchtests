
$("#errorUserModal").hide()
$("#successUserModal").hide();
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
        success: function (data) {
            console.log(data);
            $("#successAdminModal").show()
            $("#successAdminModal").text("report has been submitted!")
            //drawQuestionErrors(data)
        },
        error: function (data) {
            console.log(data);

            $("#errorAdminModal").show()

            $("#errorAdminModal").text(data.responseJSON.errors.testId)
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
            $("#successUserModal").show()
            $("#successUserModal").text("report has been submitted!")
        },
        error: function (data) {
            console.log(data);

            $("#errorUserModal").show()

            $("#errorUserModal").text(data.responseJSON.errors.testId)
        }
    })

})

