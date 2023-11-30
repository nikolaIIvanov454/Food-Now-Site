<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\AddRestaurantRequest;
use App\Http\Requests\RemoveRestaurantRequest;
use App\Http\Requests\RemoveUserRequest;

use App\Rules\RestaurantNameRule;
use App\Rules\PriceRule;
use App\Rules\DescriptionRule;

use App\Models\Restaurant;
use App\Models\User;

class AdminPageController extends Controller
{
    protected function addRestaurant(AddRestaurantRequest $request)
    {
        $data = $request->validated();

        Storage::disk('image_uploads')->put($data['image']->getClientOriginalName(), $data['image']->getRealPath());

        Restaurant::create([
            'name' => $data['name'],
            'image_path' => 'restaurant_photos/' . $data['image']->getClientOriginalName(),
            'description' => $data['description'],
            'price' => $data['price'],
            'region' => $data['region']
        ]);

        return back();
    }

    protected function removeRestaurant(RemoveRestaurantRequest $request)
    {
        $data = $request->validated();

        $restaurant_to_delete = Restaurant::all()->where('name', $data['name_to_delete'])->first();

        $restaurant_to_delete->delete();

        Storage::disk('image_uploads')->delete(str_replace('restaurant_photos/', '', $restaurant_to_delete->image_path));

        return back();
    }

    protected function removeUser(RemoveUserRequest $request)
    {
        $data = $request->validated();

        User::all()->where('username', $data['username'])->first()->delete();

        return back();
    }
}
