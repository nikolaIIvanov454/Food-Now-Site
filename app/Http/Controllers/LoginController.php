<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Exeptions\SQLException;

use App\Models\User;

class LoginController extends Controller
{
    public function create()
    {
        return view('login');
    }

    //TODO: make login secure using athentication!!!!

    public function login(Request $request)
    {   

        if ($request->isMethod('post')) {
            $username = $request->input('info');
            $password = $request->input('password');

            $users = User::all();

            foreach ($users as $user) {
                if($user->username == $username && Hash::check($password, $user->password)){
                    session()->put('logged_user_id', $user->_id);
                    session()->put('logged_username', $user->username);

                    return redirect("/home");   
                }
            }
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput($request->only('email'));
    }
}

?>