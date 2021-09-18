<?php

namespace App\Http\Controllers;

use App\Models\visitorMassage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
public function index()
{
    return view('Admin.dashboard');
}
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function handleAdmin()
    {
        return view('Admin.dashboard');
    }
}
