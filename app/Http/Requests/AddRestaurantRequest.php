<?php

namespace App\Http\Requests;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use App\Models\Restaurant;

use App\Rules\RestaurantNameRule;
use App\Rules\PriceRule;
use App\Rules\DescriptionRule;

class AddRestaurantRequest extends FormRequest
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
            'name' => ['required', 'unique:restaurants', new RestaurantNameRule()],
            'image' => ['required', 'image'],
            'description' => ['required', new DescriptionRule()],
            'price' => ['required', new PriceRule()],
            'region' => ['required', Rule::in(Restaurant::getRestaurantRegions())]
        ];
    }

    public function messages(): array
    {
        return [
            'image.image' => 'Файлът трябва да е снимка.',
            'name.unique' => 'Името на ресторанта е вече използвано.',
            'region.in' => 'Невалиден регион.'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            back()->withErrors($validator, 'first_form')->withInput()
        );
    }
}
