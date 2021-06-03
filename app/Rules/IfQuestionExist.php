<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class IfQuestionExist implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $question;
    protected $id;
    public function __construct($question,$id)
    {
        $this->question=$question;
        $this->id=$id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if(DB::table("questions")->where("id","!=",$this->id)->where("question","=",$this->question)->doesntExist()){
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This question already exists';
    }
}
