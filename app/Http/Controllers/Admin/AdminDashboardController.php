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
        $user = auth()->user();
        if($user && ( $user->role == 1 || $user->role == 2) ){
            $total_donation = Donation::where('type', 'Funds')
            ->whereIn('fund_type', ['cash', 'cheque'])->where('user_id',$user->id)->sum('amount');
            $total_trees = Tree::whereHas('donations', function ($query) {
                $query->where('user_id', auth()->id());
            })->count();
            $donations_in_count = Donation::where('flow','In')->where('user_id',$user->id)->count();
            $donations_out_count = Donation::where('flow','Out')->where('user_id',$user->id)->count();
            return view('admin.dashboard',compact('total_donation','total_trees','donations_in_count','donations_out_count'));
        }
        if(auth('admin')->check()){
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
        return redirect()->back();
        

    }
}
