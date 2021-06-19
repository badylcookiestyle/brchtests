<?php

namespace App\Http\Requests;

use App\Rules\NewPasswordValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class changePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    /*   oldPassword: $("#fPassword").val(),
                    newPassword: $("#nPassword").val(),
                    newPasswordAgain:$("#nPasswordr").val(),
     */
    public function rules()
    {
       $currentUser = auth()->user();
        $oldPassword=$this->input("oldPassword");
        return [
            "oldPassword"=>"required|string|min:6|max:32",
            "newPassword"=>['required','string','min:8','max:32','different:oldPassword',new NewPasswordValidationRule($oldPassword,$currentUser->password)],
            "newPasswordAgain"=>"required|string|min:6|max:32|same:newPassword",

        ];
    }
}
