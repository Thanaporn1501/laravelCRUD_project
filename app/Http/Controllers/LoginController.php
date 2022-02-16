<?php

namespace App\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
       function loginForm() {
        return view('login-form');
    }

    function authenticate(Request $request){
        $data = $request->getParsedBody();
        $credentials = [
            'email' => $data['email'],
            'password' => $data['password'],
    ];

        if (Auth::attempt($credentials)) {
            // regenerate session ID
            session()->regenerate();

            // redirect to the requested URL or
            // to route product if does not specify
            return redirect()->intended('home');
        }
            // if cannot authenticate redirect back to loginForm
            // with error message.
            return back()->withErrors([
                'email' => 'The email address you entered is not connected to an account.',
            ]);
    }

    function logout() {
        Auth::logout();

        session()->invalidate();

        // regenerate CSRF token
        session()->regenerateToken();

        return redirect()->route('login');
    }
}

