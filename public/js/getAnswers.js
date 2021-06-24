$(document).ready(function () {
    $("#check").click(function () {
        if (counter != 0) {
            answers = []
            for (i = 1; i <= counter; i++) {
                answers.push($("[name='questionRadios" + i + "']:checked").val())
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            var formData = {
                answers: answers,
                testId: testId
            }
            $.ajax({
                type: "POST",
                url: "checkAnswers",
                data: formData,
                dataType: 'json',
                success: function (data) {
                    console.log(data)
                    $("#test-section").toggle();
                    $("#score").append("<h1>your score "+data.score +"</h1>")
                    if(data.invalidAnswers.length>0){
                        $("#score").append("<h2>You have answered wrongly to the questions below</h2><h3>Yours score "+data.finalScore+"%</h3>");
                        for (i = 0; i < data.invalidAnswers.length; i++) {
                            $("#score").append("<h5>" + data.invalidAnswers[i] + "</h5>");
                        }}
                    $("#score-section").toggle()
                },
                error: function (data) {
                }
            });
        }
    });
    $("#again").click(function () {
        $("#score").empty()
        $("input[type=radio]").prop('checked',false);
        answers=[]
        $("#test-section").toggle();
        $("#score-section").toggle()
    });
})
