<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function home()
    {
        return view('user.home');
    }

    public function contact()
    {
        return view('user.contact');
    }

    public function sendContact(Request $request)
    {
        dd($request->all());
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);
        return view('user.contact');
    }

    public function service()
    {
        return view('user.service');
    }

    public function bmi()
    {
        return view('user.BMI');
    }

    public function app()
    {
        return view('user.layouts.app');
    }
}
