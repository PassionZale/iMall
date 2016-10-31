<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class HomeController extends BaseController
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
            return view('home');
        }else{
            return Redirect::action('Auth\AuthController@showLoginForm');
        }
    }
}
