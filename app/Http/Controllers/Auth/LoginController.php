<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{


    use AuthenticatesUsers;


    protected $redirectTo ;



    public function __construct()
    {
        if(Auth::check() && Auth::user()->role_id == 1)
        {
            $this->redirectTo=route('admin.dashboard');
        }
        elseif(Auth::check() && Auth::user()->role_id == 3)
        {
            $this->redirectTo=route('manager.dashboard');
        }
        elseif(Auth::check() && Auth::user()->role_id == 4)
        {
            $this->redirectTo=route('stuff.dashboard');
        }
//        else{
//            $this->redirectTo=route('');
//        }

        $this->middleware('guest')->except('logout');
    }



}
