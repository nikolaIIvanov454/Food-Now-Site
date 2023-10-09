<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Restaurant;


class RestaurantListController extends Controller
{
    public function loadRestaurants(Request $request)
    {
        $municipality = $request->input('oblast');

        //get options from database maybe using a new model class called Region and maybe then use some of the code bellow
        // $municipality = $request->input('oblast');
        // $region = MongoDB::collection('regions')->where('city', $municipality)->first();

        // // Handle case where the region is not found
        // if (!$region) {
        //     // Redirect or return an error response according to your application's logic
        //     // For example:
        //     // return redirect()->route('some_route')->with('error', 'Region not found');
        //     // OR
        //     // return response()->json(['error' => 'Region not found'], 404);
        // }

        // // Assuming you have a restaurants field in your regions collection that contains restaurant data
        // $restaurants = isset($region['restaurants']) ? $region['restaurants'] : [];

        // return view('search_results', compact('restaurants'));


        $info = [
            'name' => $name,
            'image_path' => $image,
            'description' => $description,
            'price' => $price,
            'region' => $region
        ];

        $region = Restaruant::create($info);

        dd($region);

        return view('search_results', compact('result'));
    }
}

?>