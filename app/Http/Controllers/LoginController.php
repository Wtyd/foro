<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{User, Token};

class LoginController extends Controller
{
    public function create()
    {
        return view('login.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users'
        ]);

        $user = User::where('email', $request->get('email'))->first();

        Token::generateFor($user)->sendByEmail();

        alert('Enviamos a tu email un enlace para que inicies sesión'); //funcion del componente Styde

        return back();
    }

    public function confirm()
    {
        return view('login.confirm');
    }
}
