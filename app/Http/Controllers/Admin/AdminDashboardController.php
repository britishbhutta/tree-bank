<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index(){
        $donar_count = User::where('role','donar')->count();
        $volunteers_count = User::where('role','volunteers')->count();
        $total_donation = Donation::where('type','funds')->sum('amount');
        $total_trees = Donation::where('type','trees')->sum('amount');
        $donations_given_count = Donation::where('flow','given')->count();
        $donations_taken_count = Donation::where('flow','taken')->count();
        //return view('treebank');
        return view('admin.dashboard',compact('donar_count','volunteers_count','total_donation','total_trees','donations_given_count','donations_taken_count'));
    }
}
