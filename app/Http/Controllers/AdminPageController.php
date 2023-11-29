<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

use App\Rules\RestaurantNameRule;
use App\Rules\RegionRule;
use App\Rules\PriceRule;
use App\Rules\DescriptionRule;

use App\Models\Restaurant;
use App\Models\User;

class AdminPageController extends Controller
{
    protected function addRestaurant(Request $request)
    {
        $valid_regions = Restaurant::getRestaurantRegions();

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'unique:restaurants', new RestaurantNameRule()],
            'image' => ['required', 'image'],
            'description' => ['required', new DescriptionRule()],
            'price' => ['required', new PriceRule()],
            'region' => ['required', Rule::in($valid_regions)]
        ]); 

        $validator->setCustomMessages([
            'image.image' => 'Файлът трябва да е снимка.',
            'name.unique' => 'Името на ресторанта е вече използвано.',
            'region.in' => 'Невалиден регион.'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator, 'first_form')->withInput();
        }

        $data = $validator->validated();

        Storage::disk('image_uploads')->store($data['image']->getClientOriginalName(), $data['image']->getRealPath());

        Restaurant::create([
            'name' => $data['name'],
            'image_path' => 'restaurant_photos/' . $data['image']->getClientOriginalName(),
            'description' => $data['description'],
            'price' => $data['price'],
            'region' => $data['region']
        ]);   
        
        return back();
    }

    protected function removeRestaurant(Request $request)
    {
        $valid_restaurants = Restaurant::getRestaurantsAndImagePath();

        $validator = Validator::make($request->all(), [ 
            'name_to_delete' => ['required', new RestaurantNameRule(), Rule::in($valid_restaurants)]
        ]); 

        $validator->setCustomMessages([
            'name_to_delete.in' => 'Ресторантът не съществува.'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator, 'second_form')->withInput();
        }

        $data = $validator->validated();

        $restaurant_to_delete = Restaurant::all()->where('name', $data['name_to_delete'])->first();

        $restaurant_to_delete->delete();

        Storage::disk('image_uploads')->delete(str_replace('restaurant_photos/', '', $restaurant_to_delete->image_path));

        return back();
    }   

    protected function removeUser(Request $request)
    {
        $valid_usernames = User::getUserNames();

        $validator = Validator::make($request->all(), [ 
            'username' => ['required', new RestaurantNameRule(), Rule::in($valid_usernames)]
        ]); 

        $validator->setCustomMessages([
            'username.in' => 'Невалиден потребител.'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator, 'third_form')->withInput();
        }

        $data = $validator->validated();

        User::all()->where('username', $data['username'])->first()->delete();

        return back();
    }
}
