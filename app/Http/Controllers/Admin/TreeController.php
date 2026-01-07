<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Photo;
use App\Models\Project;
use App\Models\Tree;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'projects',
            'photos',
        ]);

        $gardner = User::where('role', 3)->get();
        $caretaker = User::where('role', 4)->get();

        return view('admin.trees.show', compact('tree', 'gardner', 'caretaker'));
    }

    public function update(Request $request, Tree $tree)
    {
        $fields = [
            'tree_type', 'planting_status', 'age', 'bought_date', 'location',
            'planted_date', 'last_visited_date', 'notes', 'purpose',
            'visit_req', 'death', 'health_condition', 'user_id', 'user_id_ct',
        ];

        foreach ($fields as $field) {
            if ($request->has($field)) {
                $tree->$field = $request->$field;
            }
        }
        $tree->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Tree details updated successfully!',
        ]);
    }

    public function deletePhoto($id)
    {
        $photo = Photo::findOrFail($id);
        if ($photo->photo_path && Storage::exists($photo->photo_path)) {
            Storage::delete($photo->photo_path);
        }
        $photo->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Photo deleted successfully!',
        ]);
    }

    // Upload photos
    public function uploadPhotos(Request $request, Tree $tree)
    {
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $file) {
                $path = $file->store('tree_photos', 'public');
                Photo::create([
                    'tree_id' => $tree->id,
                    'photo_path' => $path,
                ]);
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Photo(s) uploaded successfully!',
        ]);
    }
}
