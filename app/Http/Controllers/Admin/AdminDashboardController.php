<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\User;
use App\Models\Tree;
use App\Models\Project;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index(){
        $donar_count = User::whereIn('role', [1, 2])->count();
        $gardner_count = User::where('role','3')->count();
        $caretaker_count = User::where('role','4')->count();
        $total_donation = Donation::where('type', 'Funds')
        ->whereIn('fund_type', ['cash', 'cheque'])->sum('amount');
        $total_trees = Tree::count();
        $donations_in_count = Donation::where('flow','In')->count();
        $donations_out_count = Donation::where('flow','Out')->count();
        $projects_count = Project::count();
        return view('admin.dashboard',compact('donar_count','gardner_count','caretaker_count','projects_count','total_donation','total_trees','donations_in_count','donations_out_count'));
    }
}
