<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PasswordRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(!preg_match('/\A(?>(?<upper>[A-Z])|(?<lower>[a-z])|(?<digit>[0-9])|.){8,}?(?(upper)(?(lower)(?(digit)|(?!))|(?!))|(?!))$/', $value)){
            $fail('Паролата трябва да е с поне 8 символа, включително голяма и малка буква.');
        }
    }
}
