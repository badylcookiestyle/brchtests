<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class editCommentRequest extends FormRequest
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
        //I will add here new validation rule in the future
        return [
            "commentArea"=>"required|min:2|max:250",
            "commentId"=>"required"
        ];
    }
}
