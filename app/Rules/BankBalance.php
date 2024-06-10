<?php

namespace App\Rules;
use Illuminate\Contracts\Validation\Rule;

class BankBalance implements Rule

{
    public function passes($attribute, $value)

    {
        return $value >= 0;
    }

    public function message()

    {
        return 'The bank balance must be zero or a positive number.';
    }
}
