<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Tree;
use App\Models\Donation;


class TreeController extends Controller
{

public function create()
{
    $donationIn = Donation::where('type', 'Trees')
                        ->where('flow', 'In')
                        ->get();

    $donationOut = Donation::where('type', 'Trees')
                        ->where('flow', 'Out')
                        ->get();

    return view('admin.trees.create', compact('donationIn', 'donationOut'));
}

 public function index(Request $request)
{
    $trees = Tree::with(['projects','treeTypes'])
        ->when($request->tree_id, function ($q) use ($request) {
            $q->where('id', $request->tree_id);
        })
        ->when($request->project_id, function ($q) use ($request) {
            $q->where('project_id', $request->project_id);
        })
        ->latest()
        ->paginate(10);

    if ($request->ajax()) {
        return view('admin.trees.partials.table', compact('trees'))->render();
    }

    $projects = Project::all();
    return view('admin.trees.index', compact('trees','projects'));
}


   public function show(Tree $tree)
{
    $tree->load([
        'donations.users',   
        'donationsOut.users', 
        'treeTypes',
        'plantedBy',
        'CareTakenBy',
        'projects'
    ]);
    
    return view('admin.trees.show', compact('tree'));
}


   public function update(Request $request, Tree $tree)
{
    $fields = $request->only([
        'tree_type','planting_status','location','planted_date','last_visited_date',
        'notes','purpose','age','bought_date'
    ]);

    $tree->update($fields);

    if($request->expectsJson()){
        return response()->json([
            'success' => true,
            'message' => 'Tree details updated successfully!'
        ]);
    }

    return redirect()->route('admin.trees.show', $tree->id)
                     ->with('success','Tree details updated successfully!');
}



}
