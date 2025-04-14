<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return view('dashboard');
        }
        return back();
    }

    public function verify()
    {
        return view('user.verify');
    }

    public function resend()
    {

        $user = Auth::user();

        if ($user->hasVerifiedEmail) {
            return redirect()->route('home')->with('success', 'your email was verified');
        }

        $user->SendEmailVerificationNotification->with('success', 'verification sent successfully');
    }
}
