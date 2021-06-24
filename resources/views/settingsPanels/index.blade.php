@extends('layouts.app')

@section('content')
    <div class="container text-center">

            <div class="w-4/8 m-auto text-center password-errors">
                <ul>
                    <li class="list-group-item list-group-item-action list-group-item-danger"
                        id="errorOldPassword"></li>
                    <li class="list-group-item list-group-item-action list-group-item-danger"
                        id="errorNewPassword"></li>
                    <li class="list-group-item list-group-item-action list-group-item-danger"
                        id="errorNewPasswordAgain"></li>
                </ul>
            </div>

        <form  method="POST">
            @csrf
            @method("POST")
            <div class="form-group">
                <label for="fPassword">  <h1>{{__('old Password')}}</h1>
                    <input type="password" name="fPassword" id="fPassword">
                </label>
            </div>
            <div class="form-group">
                <label for="nPassword">  <h1>{{__('new Password')}}</h1>
                    <input type="password" name="nPassword" id="nPassword">
                </label>
            </div>
            <div class="form-group">
                <label for="nPasswordr">  <h1>{{__('new Password again')}}</h1>
                    <input type="password" name="nPasswordr" id="nPasswordr">
                </label>
            </div>
            </form>
            <button class="btn btn-danger mr-3" id="changePasswordButton"> {{__('change password')}}
            </button>
    </div>
    <script>
        function hideErrors(){
            $("#errorOldPassword").hide()
            $("#errorNewPassword").hide()
            $("#errorNewPasswordAgain").hide()
        }
        $(".password-errors").hide()
        hideErrors()
        $(document).ready(function () {
            //editing form
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

    </script>
    </script>
@endsection
