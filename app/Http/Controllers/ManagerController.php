<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function profileView() {
        return view('Manager.profile');
    }
    public function Dashboard() {
        return view('Manager.dashboard');
    }

}
