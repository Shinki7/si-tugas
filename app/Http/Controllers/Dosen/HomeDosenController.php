<?php

namespace App\Http\Controllers\Dosen;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class HomeDosenController extends Controller
{
    public function index(){
        return view('dosen.home.index');
    }
}
