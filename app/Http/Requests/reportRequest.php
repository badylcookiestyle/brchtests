<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\IfTestHasBeenReportedRule;
use App\Rules\IfItsYourTest;
class reportRequest extends FormRequest
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
            "title"=>"required|min:2|max:64|in:sexual content,hate speech,spam,racism",
            "description"=>"required|min:32|max:250",
            "action"=>"required|in:warningOnly,warningWithDelete,reportOnly",
            "testId"=>["required","numeric","gt:0",new IfItsYourTest($this->input("testId")),new IfTestHasBeenReportedRule($this->input("testId"))]
        ];
    }
}
