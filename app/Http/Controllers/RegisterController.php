<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            $confirm_password = $request->input('confirm-password');

            if($password == $confirm_password){

                $hashedPassword = Hash::make($password);

                $newUser = new User();
                $newUser->username = $username;
                $newUser->email = $email;
                $newUser->password = $hashedPassword;
                $newUser->save();

                return redirect()->route('login');
            }

            return back()->with('error', "Невалидни данни!");
        }
    }
}

?>