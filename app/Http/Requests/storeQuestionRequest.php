<?php

namespace App\Http\Requests;

use App\Rules\IfQuestionExist;
use Illuminate\Foundation\Http\FormRequest;

class storeQuestionRequest extends FormRequest
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

                "testQuestion"=>"sometimes|min:2|max:64",
                "flexRadioDefault"=>"sometimes",
                "correct_answer"=>"required|min:1|max:4|gt:0",
                "testAnswer1"=>"sometimes|min:2|max:64",
                "testAnswer2"=>"sometimes|min:2|max:64",
                "testAnswer3"=>"sometimes|min:2|max:64",
                "testAnswer4"=>['sometimes','min:2','max:64',new IfQuestionExist($this->testQuestion,$this->id) ]

        ];
    }
}
