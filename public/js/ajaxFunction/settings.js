function hideErrors(){
    $("#errorOldPassword").hide()
    $("#errorNewPassword").hide()
    $("#errorNewPasswordAgain").hide()
}
$(".password-errors").hide()
hideErrors()
$(document).ready(function () {
    $("#changePasswordButton").click(function () {
        $(".password-errors").hide()
        hideErrors()
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        var formData = {
            oldPassword: $("#fPassword").val(),
            newPassword: $("#nPassword").val(),
            newPasswordAgain:$("#nPasswordr").val(),
        }
        $.ajax({
            type: "POST",
            url: "changePasswordRequest",
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data)

            },
            error: function (data) {
                $(".password-errors").show()
                console.log(data.responseJSON.errors.oldPassword)
                if(data.responseJSON.errors.oldPassword){
                    $("#errorOldPassword").show();
                    $("#errorOldPassword".toString()).text(data.responseJSON.errors.oldPassword)}
                if(data.responseJSON.errors.newPassword){
                    $("#errorNewPassword").show();
                    $("#errorNewPassword".toString()).text(data.responseJSON.errors.newPassword)}
                if(data.responseJSON.errors.newPasswordAgain){
                    $("#errorNewPasswordAgain").show();
                    $("#errorNewPasswordAgain".toString()).text(data.responseJSON.errors.newPasswordAgain)}
            }
        });
    })
})
