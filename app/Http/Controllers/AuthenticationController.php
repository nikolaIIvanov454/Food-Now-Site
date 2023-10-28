<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Models\User;

class AuthenticationController extends Controller
{
    protected function createRegister()
    {
        return view('register');
    }

    protected function createLogin()
    {
        return view('login');
    }

    protected function login(Request $request)
    {   

        $request->validate([
            'info' => 'required',
            'password' => 'required'
        ]);

        if (filter_var($request->info, FILTER_VALIDATE_EMAIL)) {
            $infoField = 'email';
        }

        $info = $request->input('info');

        $credentials = [
            filter_var($request->info, FILTER_VALIDATE_EMAIL) ? 'email' : 'username' => $request->info, 'password' => $request->password,
        ];

        $credentials['password'] = $request->password;    

        if (Auth::attempt($credentials)) 
        {
            $user = Auth::user();
            
            session()->put('logged_user_id', $user->_id);
            session()->put('logged_username', $user->username);

            return redirect()->intended(route('home'));
        }

        return redirect()->route('login_user')->with('error', 'Invalid credentials');
    }

    protected function registerUser(Request $request){

            $request->validate([
                'username' => 'required',
                'email' => 'required | email | unique:users',
                'password' => 'required',
                'confirm-password' => 'required | same:password'
            ]);

            $username = $request->input('username');
            $email = $request->input('email');
            $password = $request->input('password');
            $confirm_password = $request->input('confirm-password');

            if($password == $confirm_password){
                $hashedPassword = Hash::make($password);

                User::create([
                    'username' => $username,
                    'email' => $email,
                    'password' => $hashedPassword,
                ]);

                return redirect()->intended(route('login_user'));
            }

            return back()->with('error', "Невалидни данни!");
    }

    protected function logout(Request $request){
        Session::flush();
        Auth::logout();
        
        return redirect()->route('login_user');
    }
}

?>