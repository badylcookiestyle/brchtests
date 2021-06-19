<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use  Illuminate\Support\Facades\Hash;
class NewPasswordValidationRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $oldPassword;
    protected $newPassword;
    public function __construct($newPassword,$oldPassword)
    {
        $this->newPassword=$newPassword;
        $this->oldPassword=$oldPassword;
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
        if(!Hash::check($this->newPassword,$this->oldPassword)){
            return false;
        }
        else{
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Password is incorrect.';
    }
}
