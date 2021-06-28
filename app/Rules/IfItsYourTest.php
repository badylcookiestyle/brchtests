<?php

namespace App\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Rule;
use App\Models\Test;
class IfItsYourTest implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    protected $testId;
    public function __construct($testId)
    {
        $this->testId=$testId;

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



        $test=Test::find($this->testId);
        if($test->user_id== Auth::id()){
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "U can't report your own test";
    }
}
