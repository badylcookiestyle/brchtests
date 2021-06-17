<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateQuestionRequest extends FormRequest
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
    public function rules()
    {
        return [
            "testQuestionEdit"=>"sometimes|min:2|max:64",
            "flexRadioDefaultEdit"=>"sometimes",
            "correct_answerEdit"=>"required|min:1|max:4|gt:0",
            "testAnswer1Edit"=>"sometimes|min:2|max:64",
            "testAnswer2Edit"=>"sometimes|min:2|max:64",
            "testAnswer3Edit"=>"sometimes|min:2|max:64",
            "testAnswer4Edit"=>'sometimes|min:2|max:64',
            "testIdEdit"=>'required'
        ];
    }
}
