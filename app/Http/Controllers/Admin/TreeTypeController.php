<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TreeType;
use App\Models\Tree;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TreeTypeController extends Controller
{
    // List all tree types
    public function index() {
        $treeTypes = TreeType::all();
        return view('admin.tree_types.index', compact('treeTypes'));
    }

    // Show create form
    public function create() {
        return view('admin.tree_types.create');
    }

    // Store new tree type
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $treeType = new TreeType();
        $treeType->name = $request->name;
        $treeType->description = $request->description;
        $treeType->save();

        return redirect()->route('admin.tree_types.index')->with('success', 'Tree type added successfully.');
    }

    // Show edit form
    public function edit($id) {
        $treeType = TreeType::findOrFail($id);
        return view('admin.tree_types.edit', compact('treeType'));
    }

    // Update tree type
    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $treeType = TreeType::findOrFail($id);
        $treeType->name = $request->name;
        $treeType->description = $request->description;
        $treeType->save();

        return redirect()->route('admin.tree_types.index')->with('success', 'Tree type updated successfully.');
    }

    // Delete tree type
    public function destroy($id) {
        $treeType = TreeType::findOrFail($id);
        $treeType->delete();

        return redirect()->route('admin.tree_types.index')->with('success', 'Tree type deleted successfully.');
    }

    public function availableTrees(Request $request)
{
    $trees = Tree::select('type_id', DB::raw('count(*) as qty'))
        ->where('project_id', $request->project_id)
        ->whereNull('donation_id_out')
        ->groupBy('type_id')
        ->with('type:id,name')
        ->get()
        ->map(function ($t) {
            return [
                'type_id' => $t->type_id,
                'name'    => $t->type->name,
                'qty'     => $t->qty,
            ];
        });

    return response()->json($trees);
}

}
