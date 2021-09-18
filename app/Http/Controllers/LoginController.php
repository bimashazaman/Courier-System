<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/admin/route';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $inputVal = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt(array('email' => $inputVal['email'], 'password' => $inputVal['password']))) {
            if (auth()->user()->role_id == 1) {
                return redirect()->route('admin.route');
            } elseif (auth()->user()->role_id == 2) {
                return redirect()->route('stuff.dashboard');
            } elseif (auth()->user()->role_id == 3) {
                return redirect()->route('manager.dashboard');
            }
        }

    }

}
