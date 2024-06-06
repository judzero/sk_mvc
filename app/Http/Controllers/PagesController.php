<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //home
    public function home()
    {
        return view("pages/home");
    }
    //register
    public function register()
    {
        return view("pages/register");
    }
    //login
    public function login()
    {
        return view("pages/login");
    }
}
