<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Tree;
use App\Models\User;
use Illuminate\Http\Request;

class FrontEndCountController extends Controller
{
     public function myTreesCount(){
        $myTrees = Tree::whereHas('donations', function ($query) {
            $query->where('user_id', auth()->id());
        })->count();
        return response()->json([
            'myTrees' => $myTrees,
        ]);
    }

    public function Counts(){
        $totalTrees = Tree::count();
        $volunteers = User::count();
        $cities = 50;
        $thisMonth = Tree::whereMonth('created_at', now()->month)
                 ->whereYear('created_at', now()->year)
                 ->count();
        return response()->json([
            'total' => $totalTrees,
            'volunteers' => $volunteers,
            'cities' => $cities,
            'thisMonth' => $thisMonth,
        ]);
    }
}
