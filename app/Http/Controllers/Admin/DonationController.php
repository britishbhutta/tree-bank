<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Project;
use App\Models\Tree;
use App\Models\TreeType;
use App\Models\User;
use App\Models\Work_Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DonationController extends Controller
{
    public function index()
{
    $user = auth()->user();
        if($user && ( $user->role == 1 || $user->role == 2) ){
            $donations = Donation::where('user_id',$user->id)->orderBy('id', 'desc')
                ->paginate(10);
        }
        if(auth('admin')->check()){
            $donations = Donation::with(['users', 'workshop.projects', 'trees.projects'])
                ->orderBy('id', 'desc')
                ->paginate(10);
        }

    return view('admin.donation.index', compact('donations'));
}

    public function buyTreesIndex(){
        if(auth('admin')->check()){
            $donations = Donation::with(['users', 'workshop.projects', 'trees.projects'])
                ->where('type', 'Funds')->where('no_of_bought_trees', null)
                ->orderBy('id', 'desc')
                ->paginate(10);
        }

        return view('admin.donation.buyTreeIndex', compact('donations'));
    }
    public function buyTreesCreate(Request $request){
        $users = User::select('id', 'name')->whereIn('role', [1,2,5])->get();

        $projects = Project::select('id', 'name')->get();
        $workshops = Work_Shop::select('id', 'name', 'project_id')->get();
        $treetype = TreeType::select('id', 'name')->get();
        $donation = Donation::where('id',$request->donation_id)->first();
        session(['editable_donation_id' => $donation->id]);
        return view('admin.donation.buyTreeCreate', compact( 'projects', 'workshops', 'treetype', 'donation','users'));

    }

    public function buyTreeStore(Request $request){
        if($request->donation_id == session('editable_donation_id')){
            $donation_id = session('editable_donation_id');
        }else{
            return back()->withErrors('Please Use valid Donation to Buy Trees.');
        }
        $rules = [
            'project_id' => 'required|exists:projects,id',
            'ws_id' => 'nullable|exists:work_shops,id',
            'type' => 'required|in:Trees,Funds',
            'amount' => 'required|integer|min:1',
        ];
        if ($request->type === 'Trees') {
            if (! isset($request->trees['type_id']) || ! count($request->trees['type_id'])) {
                return back()->withErrors('Please select at least 1 tree type.')->withInput();
            }

            $rules['trees.type_id.*'] = 'required|exists:tree_types,id';
            $rules['trees.name_id.*'] = 'required|exists:tree_names,id';
            $rules['trees.qty.*'] = 'required|integer|min:1';
        }

        $validated = $request->validate($rules);

        if (! empty($validated['ws_id'])) {
            $workshop = Work_Shop::find($validated['ws_id']);
            if (! $workshop || (int) $workshop->project_id !== (int) $validated['project_id']) {
                return back()->withErrors('Selected workshop does not belong to selected project')->withInput();
            }
        }

        if ($validated['type'] === 'Trees') {
            $totalTrees = array_sum($request->trees['qty']);
            if ($totalTrees != $validated['amount']) {
                return back()->withErrors('Total tree quantity must equal the amount')->withInput();
            }
        }

        DB::beginTransaction();

        try {
            if ($validated['type'] === 'Trees') {
                foreach ($request->trees['type_id'] as $index => $typeId) {
                    $treeNameId = $request->trees['tree_name_id'][$index] ?? null;
                    $qty = $request->trees['qty'][$index] ?? 0;

                    if (! $typeId || ! $treeNameId || $qty <= 0) {
                        continue;
                    }
                    for ($i = 0; $i < $qty; $i++) {
                        Tree::create([
                            'donation_id' => $donation_id,
                            'type_id' => $typeId,
                            'tree_name_id' => $treeNameId,
                            'project_id' => $validated['project_id'],
                            'death' => '0'
                        ]);
                    }
                }
            }

            DB::commit();
            $donation = Donation::where('id',$donation_id)->first();
            $donation->no_of_bought_trees = $qty ;
            $donation->update();
            session()->forget('editable_donation_id');
            return redirect()->route('donation.buy.trees')->with('success', 'Trees Has Been Bought successfully. Under The Donation Number: '.$donation->donation_number);

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors($e->getMessage())->withInput();
        }
        
    }
    public function create()
    {
        $users = User::select('id', 'name')->whereIn('role', [1,2,5])->get();
        $projects = Project::select('id', 'name')->get();
        $workshops = Work_Shop::select('id', 'name', 'project_id')->get();
        $treetype = TreeType::select('id', 'name')->get();

        $lastDonation = Donation::latest('id')->first();
        $donationNumber = 'TB-'.str_pad($lastDonation ? $lastDonation->id + 1 : 1, 3, '0', STR_PAD_LEFT);

        return view('admin.donation.create', compact('users', 'projects', 'workshops', 'treetype', 'donationNumber'));
    }

    public function store(Request $request)
    {
        $rules = [
            'user_id' => 'required|exists:users,id',
            'project_id' => 'required|exists:projects,id',
            'ws_id' => 'nullable|exists:work_shops,id',
            'type' => 'required|in:Trees,Funds',
            'flow' => 'required|in:In,Out,Own',
            'amount' => 'required|integer|min:1',
        ];

        if ($request->type === 'Funds') {
            $rules['fund_type'] = 'required|in:Cash,Cheque';
        }

        if ($request->type === 'Trees') {
            if (! isset($request->trees['type_id']) || ! count($request->trees['type_id'])) {
                return back()->withErrors('Please select at least 1 tree type.')->withInput();
            }

            $rules['trees.type_id.*'] = 'required|exists:tree_types,id';
            $rules['trees.name_id.*'] = 'required|exists:tree_names,id';
            $rules['trees.qty.*'] = 'required|integer|min:1';
        }

        $validated = $request->validate($rules);

        if (! empty($validated['ws_id'])) {
            $workshop = Work_Shop::find($validated['ws_id']);
            if (! $workshop || (int) $workshop->project_id !== (int) $validated['project_id']) {
                return back()->withErrors('Selected workshop does not belong to selected project')->withInput();
            }
        }

        if ($validated['type'] === 'Trees') {
            $totalTrees = array_sum($request->trees['qty']);
            if ($totalTrees != $validated['amount']) {
                return back()->withErrors('Total tree quantity must equal the amount')->withInput();
            }
        }

        DB::beginTransaction();

        try {
            $donation = Donation::create([
                'user_id' => $validated['user_id'],
                'project_id' => $validated['project_id'],
                'ws_id' => $validated['ws_id'] ?? null,
                'type' => $validated['type'],
                'flow' => $validated['flow'],
                'amount' => $validated['amount'],
                'fund_type' => $validated['type'] === 'Funds' ? $validated['fund_type'] : null,
                'donation_number' => 'TB-'.str_pad(Donation::max('id') + 1, 3, '0', STR_PAD_LEFT),
            ]);

            if ($validated['type'] === 'Trees') {
                foreach ($request->trees['type_id'] as $index => $typeId) {
                    $treeNameId = $request->trees['tree_name_id'][$index] ?? null;
                    $qty = $request->trees['qty'][$index] ?? 0;

                    if (! $typeId || ! $treeNameId || $qty <= 0) {
                        continue;
                    }

                    if ($validated['flow'] === 'In') {
                        for ($i = 0; $i < $qty; $i++) {
                            Tree::create([
                                'donation_id' => $donation->id,
                                'type_id' => $typeId,
                                'tree_name_id' => $treeNameId,
                                'project_id' => $validated['project_id'],
                                'death' => '0'
                            ]);
                        }
                    } elseif ($validated['flow'] === 'Own') {
                        for ($j = 0; $j < $qty; $j++) {
                            Tree::create([
                                'donation_id' => $donation->id,
                                'donation_id_out' => $donation->id,
                                'type_id' => $typeId,
                                'tree_name_id' => $treeNameId,
                                'project_id' => $validated['project_id'],
                                'planting_status' => '1',
                                'user_id' => auth()->user()->id, // Planted By
                                'planted_date' => Carbon::today(),
                                'age' => 0,
                                'user_id_ct' => auth()->user()->id, // Care Taker
                                'death' => '0',
                                'last_visited_date' => Carbon::today(),
                            ]);
                        }
                    } else {
                        $trees = Tree::where('project_id', $validated['project_id'])
                            ->where('type_id', $typeId)
                            ->where('tree_name_id', $treeNameId)
                            ->whereNull('donation_id_out')
                            ->orderBy('id')
                            ->limit($qty)
                            ->get();

                        if ($trees->count() < $qty) {
                            throw new \Exception("Not enough {$trees->first()->treeName->name} available for OUT donation");
                        }

                        foreach ($trees as $tree) {
                            $tree->update([
                                'donation_id_out' => $donation->id,
                            ]);
                        }
                    }
                }
            }

            DB::commit();

            return redirect()->route('donation.create')->with('success', 'Donation created successfully. Your Donation Number is '.$donation->donation_number);

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function edit(Donation $donation)
    {
        if($donation->no_of_bought_trees != null
         ||$donation->flow == 'Own' || $donation->trees->contains(fn ($tree) => !is_null($tree->donation_id_out))){
            return redirect()->back()->with('message', 'Edit of Donation is NOT ALLOWED');
        }
        $users = User::select('id', 'name')->whereIn('role', [1, 2])->get();
        $projects = Project::select('id', 'name')->get();
        $workshops = Work_Shop::select('id', 'name', 'project_id')->get();
        $treetype = TreeType::select('id', 'name')->get();

        if ($donation->ws_id) {
            $selectedProjectId = $donation->workshop->project_id ?? null;
        } elseif ($donation->type == 'Trees') {
            $tree = Tree::where(function ($q) use ($donation) {
                if ($donation->flow == 'Out') {
                    $q->where('donation_id_out', $donation->id);
                } else {
                    $q->where('donation_id', $donation->id);
                }
            })->first();
            $selectedProjectId = $tree->project_id ?? null;
        } else {
            $selectedProjectId = null;
        }

        $trees = Tree::where(function ($q) use ($donation) {
            if ($donation->flow === 'Out') {
                $q->where('donation_id_out', $donation->id);
            } else {
                $q->where('donation_id', $donation->id);
            }
        })
            ->get()
            ->map(function ($tree) {
                return [
                    'type_id' => $tree->type_id,
                    'tree_name_id' => $tree->tree_name_id,
                    'qty' => 1,
                ];
            })
            ->groupBy(fn ($t) => $t['type_id'].'_'.$t['tree_name_id'])
            ->map(function ($group) {
                return [
                    'type_id' => $group[0]['type_id'],
                    'tree_name_id' => $group[0]['tree_name_id'],
                    'qty' => count($group),
                ];
            })
            ->values()
            ->toArray();

        return view('admin.donation.edit', compact(
            'donation', 'users', 'projects', 'workshops', 'treetype', 'trees', 'selectedProjectId'
        ));
    }

    // public function update(Request $request, Donation $donation)
    // {
    //     $rules = [
    //         'user_id' => 'required|exists:users,id',
    //         'project_id' => 'required|exists:projects,id',
    //         'ws_id' => 'nullable|exists:work_shops,id',
    //         'type' => 'required|in:Trees,Funds',
    //         'flow' => 'required|in:In,Out',
    //         'amount' => 'required|integer|min:1',
    //         'fund_type' => 'required_if:type,Funds|in:Cash,Cheque',
    //     ];

    //     if ($request->type === 'Trees') {
    //         $rules['trees.type_id.*'] = 'required|exists:tree_types,id';
    //         $rules['trees.tree_name_id.*'] = 'required|exists:tree_names,id';
    //         $rules['trees.qty.*'] = 'required|integer|min:1';
    //     }

    //     $validated = $request->validate($rules);

    //     DB::beginTransaction();
    //     try {
    //         $donation->update([
    //             'user_id' => $validated['user_id'],
    //             'project_id' => $validated['project_id'],
    //             'ws_id' => $validated['ws_id'] ?? null,
    //             'type' => $validated['type'],
    //             'flow' => $validated['flow'],
    //             'amount' => $validated['amount'],
    //             'fund_type' => $validated['type'] === 'Funds' ? $validated['fund_type'] : null,
    //         ]);

    //         if ($validated['type'] === 'Trees') {
    //             if ($validated['flow'] === 'In') {
    //                 Tree::where('donation_id', $donation->id)->delete();
    //             } else {
    //                 Tree::where('donation_id_out', $donation->id)->update(['donation_id_out' => null]);
    //             }

    //             foreach ($request->trees['type_id'] as $i => $typeId) {
    //                 $treeNameId = $request->trees['tree_name_id'][$i];
    //                 $qty = (int) $request->trees['qty'][$i];
    //                 if ($qty <= 0) {
    //                     continue;
    //                 }

    //                 if ($validated['flow'] === 'In') {
    //                     for ($j = 0; $j < $qty; $j++) {
    //                         Tree::create([
    //                             'donation_id' => $donation->id,
    //                             'type_id' => $typeId,
    //                             'tree_name_id' => $treeNameId,
    //                             'project_id' => $validated['project_id'],
    //                         ]);
    //                     }
    //                 } else {
    //                     $trees = Tree::where('project_id', $validated['project_id'])
    //                         ->where('type_id', $typeId)
    //                         ->where('tree_name_id', $treeNameId)
    //                         ->where(function ($q) use ($donation) {
    //                             $q->whereNull('donation_id_out')
    //                                 ->orWhere('donation_id_out', $donation->id);
    //                         })
    //                         ->limit($qty)
    //                         ->get();

    //                     if ($trees->count() < $qty) {
    //                         throw new \Exception('Not enough trees available for Out donation');
    //                     }

    //                     foreach ($trees as $tree) {
    //                         $tree->update(['donation_id_out' => $donation->id]);
    //                     }
    //                 }
    //             }
    //         } else {
    //             Tree::where('donation_id', $donation->id)
    //                 ->orWhere('donation_id_out', $donation->id)
    //                 ->delete();
    //         }

    //         DB::commit();

    //         return redirect()->route('donation.index')->with('success', 'Donation updated successfully');

    //     } catch (\Exception $e) {
    //         DB::rollBack();

    //         return back()->withErrors($e->getMessage())->withInput();
    //     }
    // }

    
    public function update(Request $request, Donation $donation)
    {
        $rules = [
            'user_id' => 'required|exists:users,id',
            'project_id' => 'required|exists:projects,id',
            'ws_id' => 'nullable|exists:work_shops,id',
            'type' => 'required|in:Trees,Funds',
            'flow' => 'required|in:In,Out',
            'amount' => 'required|integer|min:1',
            'fund_type' => 'required_if:type,Funds|in:Cash,Cheque',
        ];
 
        if ($request->type === 'Trees') {
            $rules['trees.type_id.*'] = 'required|exists:tree_types,id';
            $rules['trees.tree_name_id.*'] = 'required|exists:tree_names,id';
            $rules['trees.qty.*'] = 'required|integer|min:1';
        }
 
        $validated = $request->validate($rules);
 
        if ($validated['type'] === 'Trees') {
            $totalTrees = array_sum($request->trees['qty']);
            if ($totalTrees != $validated['amount']) {
                return back()->withErrors('Total tree quantity must be equal to the amount')->withInput();
            }
        }
 
        DB::beginTransaction();
 
        try {
            $donation->update([
                'user_id' => $validated['user_id'],
                'project_id' => $validated['project_id'],
                'ws_id' => $validated['ws_id'] ?? null,
                'type' => $validated['type'],
                'flow' => $validated['flow'],
                'amount' => $validated['amount'],
                'fund_type' => $validated['type'] === 'Funds' ? $validated['fund_type'] : null,
            ]);
 
            if ($validated['type'] === 'Trees') {
                if ($validated['flow'] === 'In') {
                    Tree::where('donation_id', $donation->id)->delete();
                } else {
                    Tree::where('donation_id_out', $donation->id)->update(['donation_id_out' => null]);
                }
 
                foreach ($request->trees['type_id'] as $i => $typeId) {
                    $treeNameId = $request->trees['tree_name_id'][$i];
                    $qty = (int) $request->trees['qty'][$i];
 
                    if ($validated['flow'] === 'In') {
                        for ($j = 0; $j < $qty; $j++) {
                            Tree::create([
                                'donation_id' => $donation->id,
                                'type_id' => $typeId,
                                'tree_name_id' => $treeNameId,
                                'project_id' => $validated['project_id'],
                            ]);
                        }
                    } else {
                        $trees = Tree::where('project_id', $validated['project_id'])
                            ->where('type_id', $typeId)
                            ->where('tree_name_id', $treeNameId)
                            ->where(function ($q) use ($donation) {
                                $q->whereNull('donation_id_out')
                                ->orWhere('donation_id_out', $donation->id);
                            })
                            ->limit($qty)
                            ->get();
 
                        if ($trees->count() < $qty) {
                            throw new \Exception('Not enough trees available for Out donation');
                        }
 
                        foreach ($trees as $tree) {
                            $tree->update(['donation_id_out' => $donation->id]);
                        }
                    }
                }
            } else {
                Tree::where('donation_id', $donation->id)
                    ->orWhere('donation_id_out', $donation->id)
                    ->delete();
            }
 
            DB::commit();
 
            return redirect()->route('donation.index')->with('success', 'Donation updated successfully');
 
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors($e->getMessage())->withInput();
        }
    }
 
    public function destroy(Donation $donation, Request $request)
    {
        if($donation->flow === 'In' || $donation->flow === 'Own' ){
            if($donation->trees->contains(fn ($tree) => !is_null($tree->donation_id_out))){
                return redirect()->route('donation.index')->with('message', 'Donation can not be deleted.');
            }
            $donation->delete();
        }elseif($donation->flow === 'Out' && $donation->type === "Trees"){
            foreach ($donation->treesOut as $tree) {
                $tree->update(['donation_id_out' => null]);
                $donation->delete();
            }
            
        }
        if(isset($request->buyTreeDelete)){
            return redirect()->route('donation.buy.trees')->with('success', 'Donation Deleted successfully');
        }else{
            return redirect()->route('donation.index')->with('success', 'Donation Deleted successfully');
        }
    }
}
