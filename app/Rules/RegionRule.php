<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

use App\Models\Restaurant;

class RegionRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $valid_regions = Restaurant::getRestaurantRegions();

        foreach ($valid_regions as $region) {
            if($value != $region){
                $fail('Невалиден регион.');
            }
        }
    }
}
