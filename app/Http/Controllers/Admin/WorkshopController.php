<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Project;
use App\Models\Work_Shop;
use App\Models\Photo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class WorkshopController extends Controller
{
   
//     public function index()
// {
//     $workshops = Work_Shop::with(['users', 'projects', 'photos'])->latest()->paginate(10);
//     return view('admin.workshop.index', compact('workshops'));
// }

    public function create()
{
    $users = User::select('id','name')->get();
    $projects = Project::select('id','name')->get();

    return view('admin.workshop.create', compact('users','projects'));
}

public function store(Request $request)
{
    $request->validate([
        'project_id'  => 'required|exists:projects,id',
        'user_id'     => 'required|exists:users,id',
        'name'        => 'required|string|max:255',
        'description' => 'nullable|string',
        'start_date'  => 'required|date',
        'end_date'    => 'required|date|after:start_date',
        'location'    => 'required|string|max:255',
        'images.*'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $workshop = Work_Shop::create([
        'project_id'  => $request->project_id,
        'user_id'     => $request->user_id,
        'name'        => $request->name,
        'description' => $request->description,
        'start_date'  => $request->start_date,
        'end_date'    => $request->end_date,
        'location'    => $request->location,
    ]);

    if($request->hasFile('images')){
        foreach($request->file('images') as $image){
            $path = $image->store('workshops','public');

            Photo::create([
                'ws_id'      => $workshop->id,
                'photo_path' => $path,
            ]);
        }
    }

    return redirect()->route('admin.workshop.index')
                     ->with('success','Workshop created successfully');
}

 public function index()
    {
        $workshops = Work_Shop::with(['users', 'projects'])->latest()->paginate(10);
        return view('admin.workshop.index', compact('workshops'));
    }

    public function edit(Work_Shop $workshop)
    {
        $users = User::select('id','name')->get();
        $projects = Project::select('id','name')->get();

        $workshop->load('photos');

        return view('admin.workshop.edit', compact('workshop','users','projects'));
    }

    public function update(Request $request, Work_Shop $workshop)
    {
        $request->validate([
            'project_id'  => 'required|exists:projects,id',
            'user_id'     => 'required|exists:users,id',
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after:start_date',
            'location'    => 'required|string|max:255',
            'images.*'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $workshop->update([
            'project_id'  => $request->project_id,
            'user_id'     => $request->user_id,
            'name'        => $request->name,
            'description' => $request->description,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
            'location'    => $request->location,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('workshops','public');
                Photo::create([
                    'ws_id'      => $workshop->id,
                    'photo_path' => $path,
                ]);
            }
        }

        return redirect()->route('admin.workshop.index', $workshop->id)
                         ->with('success','Workshop updated successfully');
    }

    public function deletePhoto($id)
    {
        $photo = Photo::findOrFail($id);

        if (Storage::disk('public')->exists($photo->photo_path)) {
            Storage::disk('public')->delete($photo->photo_path);
        }

        $photo->delete();

        return response()->json(['success' => true]);
    }

    public function destroy(Work_Shop $workshop)
    {
        foreach($workshop->photos as $photo){
            if(Storage::disk('public')->exists($photo->photo_path)){
                Storage::disk('public')->delete($photo->photo_path);
            }
            $photo->delete();
        }

        $workshop->delete();

        return redirect()->route('admin.workshop.index')
                         ->with('success','Workshop and photos deleted successfully');
    }

}

