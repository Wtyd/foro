<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Token;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register/create');
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());

        Token::generateFor($user)->sendByEmail();

        return redirect('register_confirmation');
    }

    public function confirmation()
    {
        return view('register/confirmation');
    }
}
