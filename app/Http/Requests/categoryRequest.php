<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class categoryRequest extends FormRequest
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
            "category"=>"required|in:Select category,fitness,video games,anime,science,cooking,history,other",
            "text"=>"sometimes|max:64",
            "sort_category"=>"sometimes|in:average_score,created_at,amount_of_solutions,Sort",
            "sort_order"=>"required_with:sort_category|in:ASC,DESC"
        ];
    }
}
