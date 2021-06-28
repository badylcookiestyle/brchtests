<?php

namespace App\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\Test;
class IfTestHasBeenReportedRule implements Rule
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
        $test=DB::table("reports")
            ->where("reported_test",$this->testId)
            ->where("reporting_user_id",Auth::id())
            ->first();
        if($test!==null){
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
        return "you've already reported this test";
    }
}
