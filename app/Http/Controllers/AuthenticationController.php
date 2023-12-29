<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

use App\Models\User;

use App\Rules\EmailRule;
use App\Rules\PasswordRule;
use App\Rules\UsernameRule;

use App\Mail\PasswordResetMailable;

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
        $validator = Validator::make($request->all(), [
            'info' => 'required',
            'password' => 'required'
        ]);

        $validator->setCustomMessages([
            'info.required' => 'Грешно име\имейл',
            'password.required' => 'Грешна парола'
        ]);

        $inputData = $validator->validated(); 

        if (filter_var($inputData['info'], FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $inputData['info'];
        } else {
            $credentials['username'] = $inputData['info'];
        }

        $credentials['password'] = $inputData['password']; 

        if (Auth::attempt($credentials)) 
        {
            $user = Auth::user();
            
            session()->put('logged_user_id', $user->id);
            session()->put('logged_username', $user->username);

            return redirect()->intended(route('home'));
        }

        $validator->errors()->add('error', 'Невалидни потребителски данни!');

        return back()->withErrors($validator->errors())->withInput();
    }

    protected function registerUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => ['required', new UsernameRule(), 'unique:users'],
            'email' => ['required', new EmailRule(), 'unique:users'],
            'password' => ['required', new PasswordRule()],
            'confirm-password' => ['required', 'same:password']
        ]); 

        $validator->setCustomMessages([
            'confirm-password.same' => 'Паролите не съвпадат.',
            'email.unique' => 'Имейлът е зает.',
            'username.unique' => 'Името е заето.'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();   

        $hashedPassword = Hash::make($validatedData['password']);

        $user = User::create([
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => $hashedPassword,
        ]);

        if($user){
            return redirect()->intended(route('login_user'));
        }
    }

    protected function logout(Request $request){
        Session::flush();
        Auth::logout();
        
        return redirect()->route('login_user');
    }

    protected function sendRequest(Request $request){
        if($request->method() == 'GET'){
            return view('pass-reset'); 
        }

        $validation = $request->validate([
            'email' => 'required | email'
        ]);

        $email = $validation['email'];

        $user = User::where('email', $email)->first();

        if($user != null && $user->email == $email){
            $user->password_expiration_time = Carbon::now()->addMinutes(60)->toDateString();;
            $user->save();

            Mail::to($email)->send(new PasswordResetMailable($email));

            return back()->with('message', "Успешно изпращане на заявката!");
        }

        return back()->with('message', "Невалиден имейл!");
    }

    protected function resetPassword(Request $request){
        if($request->method() == 'GET'){
            return view('pass-change'); 
        }

        $validation = Validator::make($request->all(), [
            'email' => 'required | email',
            'pass' => ['required', 'min: 8', new PasswordRule()],
            'confirm' => 'same:pass'
        ]);

        $validation->setCustomMessages([
            'confirm.same' => 'Паролите не съвпадат.',
            'email.unique' => 'Имейлът е зает.'
        ]);

        $validatedInput = $validation->validated();

        $user = User::where('email', $validatedInput['email'])->first();

        if(!Carbon::parse($user->password_reset_expires_at)->isAfter(Carbon::now())){
            $new_password = Hash::make($validatedInput['pass']);

            $user->password = $new_password;
            $user->save();

            return back()->with('message', 'Успешно променяне на паролата!');
        }else{
            return back()->with('message', 'Времето за промяната на паролата изтече!');
        }
    }
}

?>