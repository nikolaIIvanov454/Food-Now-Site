<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class LoginController extends Controller
{
    public function create()
    {
        return view('login');
    }

    public function login(Request $request){    
        if ($request->isMethod('post')) {
            $username = $request->input('info');
            $password = $request->input('password');

            $users = DB::table('user_info')->get();

            foreach ($users as $user) {
                if($user->username == $username && Hash::check($password, $user->password)){
                    session()->put('logged_user_id', $user->id_user);

                    return redirect("/home");   
                }
            }
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput($request->only('email'));
    }
}

?>