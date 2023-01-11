<?php

namespace App\Http\Controllers\V1\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppAuthController extends Controller
{
    public function create()
    {
        return view("V1.auth.register");
    }

    public function store(Request $request)
    {
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password)
        ]);

        Auth::login($user);

        return redirect("/home");
    }

    public function login()
    {
        return view("V1.auth.login");
    }

    public function check(Request $request)
    {
        Auth::attempt($request->only("email", "password"));

        return redirect("home");
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route("login")->with("message", "you are log out");
    }
}
