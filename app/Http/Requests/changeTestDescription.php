<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class changeTestDescription extends FormRequest
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
            "descriptionTest"=>"required|min:32|max:500",
            "testId"=>"required",
        ];
    }
}
