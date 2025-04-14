<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function createSeeker()
    {
        return view('user.seeker-register');
    }

    public function createEmployer()
    {
        return view('user.employer-register');
    }

    public function storeSeeker(RegistrationFormRequest $request)
    {

        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'user_type' => 'seeker'

        ]);

        // Auth::login($user);

        $user->sendEmailVerificationNotification();
        return redirect()->route('login')->with('successMessage', 'your acount is created sucessfully');
    }

    public function storeEmployer(RegistrationFormRequest $request)
    {

        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'user_type' => 'employer',
            'user_trial' => now()->addWeek()

        ]);

       // Auth::login($user);

        $user->sendEmailVerificationNotification();

        return redirect()->route('login')->with('successMessage', 'your acount is created sucessfully');
    }

    public function login()
    {
        return view('user.login');
    }

    public function postlogin(Request $request)
    {

        request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        $credentials = request()->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard');
        }
    }
    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
