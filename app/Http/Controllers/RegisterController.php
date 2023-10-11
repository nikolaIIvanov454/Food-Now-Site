<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Exeptions\SQLException;

use App\Models\User;

class RegisterController extends Controller
{
    protected function create()
    {
        return view('register');
    }

    protected function registerUser(Request $request){
        if($request->isMethod('post')){
            $username = $request->input('username');
            $email = $request->input('email');
            $password = $request->input('password');

            $hashedPassword = Hash::make($password);

            try {
                $newUser = new User();
                $newUser->username = $username;
                $newUser->email = $email;
                $newUser->password = $hashedPassword;
                $newUser->save();
            }catch (SQLException $e) {
                $e->__construct("The user cannot be registered!");
            }

            return back()->withSuccess('User added successfully!');
        }
    }
}

?>