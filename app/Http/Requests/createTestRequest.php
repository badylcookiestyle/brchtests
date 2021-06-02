<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createTestRequest extends FormRequest
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
            "testTitle"=>"required|min:2|max:64",
            "descriptionTest"=>"required|min:32|max:500",
            "image"=>"sometimes|image|mimes:jpg,png,jpeg|max:4048|dimensions:max_width=100,max_height=200|dimensions:ratio=3/2"

        ];
    }
}
