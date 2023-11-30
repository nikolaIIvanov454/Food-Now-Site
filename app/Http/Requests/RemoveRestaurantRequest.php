<?php

namespace App\Http\Requests;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use App\Models\Restaurant;

use App\Rules\RestaurantNameRule;

class RemoveRestaurantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name_to_delete' => ['required', new RestaurantNameRule(), Rule::in(Restaurant::getRestaurantsAndImagePath())]
        ];
    }

    public function messages(): array
    {
        return [
            'name_to_delete.in' => 'Ресторантът не съществува.'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            back()->withErrors($validator, 'second_form')->withInput()
        );
    }
}
