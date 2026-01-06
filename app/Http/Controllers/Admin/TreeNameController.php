<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TreeName;
use App\Models\TreeType;
use Illuminate\Http\Request;

class TreeNameController extends Controller
{
    public function addTreeName()
    {
        $treeTypes = TreeType::all();

        return view('admin.tree_types.tree_names', compact('treeTypes'));
    }

    public function saveTreeName(Request $request)
    {
        $request->validate([
            'tree_type_id' => 'required|exists:tree_types,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        TreeName::create([
            'tree_type_id' => $request->tree_type_id,
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.tree_names_index')->with('success', 'Tree Name added successfully!');
    }

    public function listTreeNames()
    {
        $treeNames = TreeName::with('treeType')->get();

        return view('admin.tree_types.tree_names_index', compact('treeNames'));
    }

    public function editTreeName($id)
    {
        $treeName = TreeName::findOrFail($id);
        $treeTypes = TreeType::all();

        return view('admin.tree_types.tree_names_edit', compact('treeName', 'treeTypes'));
    }

    public function updateTreeName(Request $request, $id)
    {
        $request->validate([
            'tree_type_id' => 'required|exists:tree_types,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $treeName = TreeName::findOrFail($id);
        $treeName->update([
            'tree_type_id' => $request->tree_type_id,
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.tree_names_index')->with('success', 'Tree Name updated successfully!');
    }

    public function deleteTreeName($id)
    {
        try {
            $treeName = TreeName::findOrFail($id);
            $treeName->delete();

            return redirect()->route('admin.tree_names_index')
                ->with('success', 'Tree Name deleted successfully!');
        } catch (\Illuminate\Database\QueryException $e) {

            return redirect()->back()
                ->with('error', 'This Tree Name cannot be deleted because it is already used in trees.');
        }
    }

    public function availableTreeNames($type_id)
    {
        $names = TreeName::where('tree_type_id', $type_id)
            ->select('id', 'name')
            ->get();

        return response()->json($names);
    }
}
