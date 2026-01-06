<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Tree;
use App\Models\User;
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
    $trees = Tree::with(['projects', 'treeTypes', 'donations.users'])
        ->when($request->tree_id, function ($q) use ($request) {
            $q->where('id', $request->tree_id);
        })
        ->when($request->project_id, function ($q) use ($request) {
            $q->where('project_id', $request->project_id);
        })
        ->when($request->death !== null && $request->death !== '', function ($q) use ($request) {
            $q->where('death', $request->death);
        })
        ->when($request->user_id, function ($q) use ($request) {
            $q->whereHas('donations', function ($donation) use ($request) {
                $donation->where('user_id', $request->user_id);
            });
        })
        ->latest()
        ->paginate(10);

    if ($request->ajax()) {
        return view('admin.trees.partials.table', compact('trees'))->render();
    }

    $projects = Project::all();
    $users = User::whereIn('role', [1, 2, 5])->get();

    return view('admin.trees.index', compact('trees', 'projects', 'users'));
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

        $gardner = User::where('role', 3)->get();
        $caretaker = User::where('role', 4)->get();

        return view('admin.trees.show', compact('tree', 'gardner', 'caretaker'));
    }

    public function update(Request $request, Tree $tree)
    {
        $data = $request->all();

        if(isset($data['user_id'])) {
        $tree->user_id = $data['user_id'] ?: null;
        }

        if(isset($data['user_id_ct'])) {
            $tree->user_id_ct = $data['user_id_ct'] ?: null;
        }

        $fields = ['tree_type', 'planting_status', 'age', 'bought_date', 'location', 'planted_date', 'last_visited_date', 'notes', 'purpose','visit_req','death','health_condition'];

        foreach($fields as $field) {
            if(isset($data[$field])) {
                $tree->$field = $data[$field];
            }
        }

        $tree->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Tree details updated successfully!'
        ]);
    }

}
