<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('treebank');
    }
    public function react(){
        return view('app');
    }
}
