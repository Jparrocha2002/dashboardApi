<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');    
    }

    public function userIndex()
    {
        return view('user.index');
    }

    public function create()
    {
        return view('user.create');
    }

    public function edit()
    {
        return view('user.edit');
    }
    
    public function profile()
    {
        return view('profile.show');
    }
}
