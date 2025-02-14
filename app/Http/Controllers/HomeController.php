<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{

    public function index(){
        return view('dashboard.home');
    }
}
