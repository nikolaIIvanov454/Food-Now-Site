<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Exeptions\MySQLExeption;

class RegisterController extends Controller
{
    protected function create()
    {
        return view('register');
    }

    protected function registerUser(Request $request){
        if ($request->isMethod('post')) {
            $username = $request->input('info');
            $email = $request->input('email');
            $password = $request->input('password');

            $hashedPassword = Hash::make($password);

            try {
                $newUser = new User();
                $newUser->$username = $username;
                $newUser->$email = $email;
                $newUser->$password = $hashedPassword;
                $newUser->save();

                return back()->withSuccess('user added successfully!');
            }catch (MySQLExeption $e) {
                $e->__construct("The user cannot be registered!");
                DB::rollBack();
            }
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput($request->only('email'));
    }
}

?>