<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\TreeType;
use App\Models\Tree;
use App\Models\User;
use App\Models\Work_Shop;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DonationController extends Controller
{
    public function index()
    {
       $donations = Donation::with(['users', 'workshop.projects', 'trees.projects'])->paginate(10);
        return view('admin.donation.index', compact('donations'));
    }

    public function create()
    {
        $users = User::select('id','name')->get();
        $projects = Project::select('id','name')->get();
        $workshops = Work_Shop::select('id','name','project_id')->get();
        $treetype = TreeType::select('id','name')->get();

        $lastDonation = Donation::latest('id')->first();
        $donationNumber = 'TB-' . str_pad($lastDonation ? $lastDonation->id + 1 : 1, 3, '0', STR_PAD_LEFT);

        return view('admin.donation.create', compact('users', 'projects', 'workshops', 'treetype', 'donationNumber'));
    }

public function store(Request $request)
{
    $rules = [
        'user_id'    => 'required|exists:users,id',
        'project_id' => 'required|exists:projects,id',
        'ws_id'      => 'nullable|exists:work_shops,id',
        'type'       => 'required|in:Trees,Funds',
        'flow'       => 'required|in:In,Out',
        'amount'     => 'required|integer|min:1',
    ];

    if ($request->type === 'Funds') {
        $rules['fund_type'] = 'required|in:Cash,Cheque';
    }

    if ($request->type === 'Trees') {
        if (
            !isset($request->trees['type_id']) ||
            !count($request->trees['type_id'])
        ) {
            return back()
                ->withErrors('Please select at least 1 tree type.')
                ->withInput();
        }

        $rules['trees.type_id.*'] = 'required|exists:tree_types,id';
        $rules['trees.qty.*']     = 'required|integer|min:1';
    }

    $validated = $request->validate($rules);

    if (!empty($validated['ws_id'])) {
        $workshop = Work_Shop::find($validated['ws_id']);

        if (
            !$workshop ||
            (int) $workshop->project_id !== (int) $validated['project_id']
        ) {
            return back()
                ->withErrors('Selected workshop does not belong to selected project')
                ->withInput();
        }
    }

    if ($validated['type'] === 'Trees') {
        $totalTrees = array_sum($request->trees['qty']);

        if ($totalTrees != $validated['amount']) {
            return back()
                ->withErrors('Total tree quantity must equal the amount')
                ->withInput();
        }
    }

    DB::beginTransaction();

    try {
        $donation = Donation::create([
            'user_id'         => $validated['user_id'],
            'project_id'      => $validated['project_id'],
            'ws_id'           => $validated['ws_id'] ?? null,
            'type'            => $validated['type'],
            'flow'            => $validated['flow'],
            'amount'          => $validated['amount'],
            'fund_type'       => $validated['type'] === 'Funds'
                                    ? $validated['fund_type']
                                    : null,
            'donation_number' => 'TB-' . str_pad(
                Donation::max('id') + 1,
                3,
                '0',
                STR_PAD_LEFT
            ),
        ]);

        if ($validated['type'] === 'Trees') {

            foreach ($request->trees['type_id'] as $index => $typeId) {

                $qty = $request->trees['qty'][$index] ?? 0;
                if ($qty <= 0) continue;

                if ($validated['flow'] === 'In') {

                    for ($i = 0; $i < $qty; $i++) {
                        Tree::create([
                            'donation_id' => $donation->id,
                            'type_id'     => $typeId,
                            'project_id'  => $validated['project_id'],
                        ]);
                    }

                }
               else {

    $trees = Tree::where('project_id', $validated['project_id'])
        ->where('type_id', $typeId)
        ->whereNull('donation_id_out')
        ->orderBy('id')
        ->limit($qty)
        ->get();

    if ($trees->count() < $qty) {
        throw new \Exception('Not enough trees available for OUT donation');
    }

    foreach ($trees as $tree) {
        $tree->update([
            'donation_id_out' => $donation->id,
            'donation_id'     => $tree->donation_id,
        ]);
    }
}

            }
        }

        DB::commit();

        return redirect()
            ->route('admin.donation.create')
            ->with('success', 'Donation created successfully');

    } catch (\Exception $e) {

        DB::rollBack();

        return back()
            ->withErrors($e->getMessage())
            ->withInput();
    }
}

public function edit(Donation $donation)
{
    $users     = User::select('id','name')->get();
    $projects  = Project::select('id','name')->get();
    $workshops = Work_Shop::select('id','name','project_id')->get();
    $treetype  = TreeType::all();

    if($donation->ws_id){
        $selectedProjectId = $donation->workshop->project_id ?? null;
    } elseif($donation->type=='Trees'){
        $tree = Tree::where(function($q) use($donation){
            if($donation->flow=='Out'){
                $q->where('donation_id_out', $donation->id);
            } else {
                $q->where('donation_id', $donation->id);
            }
        })->first();
        $selectedProjectId = $tree->project_id ?? null;
    } else {
        $selectedProjectId = null;
    }

    $trees = Tree::where(function($q) use($donation){
        if($donation->flow === 'Out'){
            $q->where('donation_id_out', $donation->id);
        } else {
            $q->where('donation_id', $donation->id);
        }
    })
    ->get()
    ->groupBy('type_id')
    ->map(function($group){
        return [
            'type_id' => $group[0]->type_id,
            'qty'     => $group->count(),
        ];
    })
    ->values()
    ->toArray();

    return view('admin.donation.edit', compact(
        'donation','users','projects','workshops','treetype','trees','selectedProjectId'
    ));
}


public function update(Request $request, Donation $donation)
{
    $request->validate([
        'user_id'    => 'required|exists:users,id',
        'project_id' => 'required|exists:projects,id',
        'ws_id'      => 'nullable|exists:work_shops,id',
        'type'       => 'required|in:Trees,Funds',
        'flow'       => 'required|in:In,Out',
        'amount'     => 'required|integer|min:1',
        'fund_type'  => 'required_if:type,Funds|in:Cash,Cheque',
        'trees.type_id.*' => 'required_if:type,Trees|exists:tree_types,id',
        'trees.qty.*'     => 'required_if:type,Trees|integer|min:1',
    ]);

    DB::beginTransaction();

    try {
        $donation->update([
            'user_id'    => $request->user_id,
            'project_id' => $request->project_id,
            'ws_id'      => $request->ws_id,
            'type'       => $request->type,
            'flow'       => $request->flow,
            'amount'     => $request->amount,
            'fund_type'  => $request->type === 'Funds' ? $request->fund_type : null,
        ]);

        if($request->type === 'Trees'){
            if($request->flow === 'In'){
                Tree::where('donation_id', $donation->id)->delete();
            } else {
                Tree::where('donation_id_out', $donation->id)->update(['donation_id_out'=>null]);
            }

            $typeIds = $request->trees['type_id'] ?? [];
            $qtys    = $request->trees['qty'] ?? [];

            foreach($typeIds as $i => $typeId){
                $qty = (int) ($qtys[$i] ?? 0);
                if($qty <= 0) continue;

                if($request->flow === 'In'){
                    for($j=0;$j<$qty;$j++){
                        Tree::create([
                            'donation_id' => $donation->id,
                            'type_id'     => $typeId,
                            'project_id'  => $request->project_id,
                        ]);
                    }
                } else {
                    $trees = Tree::where('project_id', $request->project_id)
                        ->where('type_id', $typeId)
                        ->where(function($q) use($donation){
                            $q->whereNull('donation_id_out')
                              ->orWhere('donation_id_out', $donation->id);
                        })
                        ->limit($qty)
                        ->get();

                    if($trees->count() < $qty){
                        throw new \Exception('Not enough trees available for Out donation');
                    }

                    foreach($trees as $tree){
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
        return redirect()->route('admin.donation.index')->with('success','Donation updated successfully');

    } catch(\Exception $e){
        DB::rollBack();
        return back()->withErrors($e->getMessage())->withInput();
    }
}

    public function destroy(Donation $donation)
    {
        $donation->delete();
        return redirect()->route('admin.donation.index')->with('success', 'Donation deleted successfully');
    }
}
