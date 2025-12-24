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

     // Show the create form
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

//     public function store(Request $request)
// {
//     $rules = [
//         'user_id' => 'required|exists:users,id',
//         'project_id' => 'required|exists:projects,id',
//         'ws_id' => 'required|exists:work_shops,id',
//         'type' => 'required|in:Trees,Funds',
//         'flow' => 'required|in:In,Out',
//         'amount' => 'required|integer|min:1',
//     ];

//     if ($request->type === 'Funds') {
//         $rules['fund_type'] = 'required|in:Cash,Cheque';
//     }

//     if ($request->type === 'Trees') {
//         // Prevent empty trees array
//         if (!isset($request->trees['type_id']) || !count($request->trees['type_id'])) {
//             return back()
//                 ->withErrors('Please select at least 1 tree type.')
//                 ->withInput();
//         }

//         $rules['trees.type_id.*'] = 'required|exists:tree_types,id';
//         $rules['trees.qty.*'] = 'required|integer|min:1';
//     }

//     $validated = $request->validate($rules);

//     // Check workshop-project consistency
//     $workshop = Work_Shop::findOrFail($request->ws_id);
//     if ((int)$workshop->project_id !== (int)$request->project_id) {
//         return back()
//             ->withErrors('Selected workshop does not belong to selected project')
//             ->withInput();
//     }

//     // For Trees, ensure total qty equals amount
//     if ($request->type === 'Trees') {
//         $totalTrees = array_sum($request->trees['qty']);
//         if ($totalTrees != $request->amount) {
//             return back()
//                 ->withErrors('Total tree quantity must equal the amount')
//                 ->withInput();
//         }
//     }

//     DB::beginTransaction();
//     try {
//         $donation = Donation::create([
//             'user_id' => $validated['user_id'],
//             'ws_id' => $validated['ws_id'],
//             'type' => $validated['type'],
//             'amount' => $validated['amount'],
//             'fund_type' => $request->type === 'Funds' ? $validated['fund_type'] : null,
//             'flow' => $validated['flow'],
//             'donation_number' => 'TB-' . str_pad(Donation::max('id') + 1, 3, '0', STR_PAD_LEFT),
//         ]);

//         if ($request->type === 'Trees') {
//             $typeIds = $request->trees['type_id'] ?? [];
//             $qtys    = $request->trees['qty'] ?? [];

//             foreach ($typeIds as $index => $typeId) {
//                 $qty = $qtys[$index] ?? 0;
//                 if ($qty <= 0) continue; // Skip invalid qty

//                 for ($i = 0; $i < $qty; $i++) {
//                     Tree::create([
//                         'donation_id' => $donation->id,
//                         'type_id' => $typeId,
//                         'project_id' => $request->project_id,
//                     ]);
//                 }
//             }
//         }

//         DB::commit();
//         return redirect()->route('admin.donation.create')->with('success', 'Donation created successfully');
//     } catch (\Exception $e) {
//         DB::rollBack();
//         return back()->withErrors('Something went wrong, please try again')->withInput();
//     }
// }

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

    // Funds specific rule
    if ($request->type === 'Funds') {
        $rules['fund_type'] = 'required|in:Cash,Cheque';
    }

    // Trees specific rules
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

    /**
     * ✅ Workshop → Project relation check
     * Sirf tab chale jab ws_id ho
     */
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

    /**
     * ✅ Trees quantity validation
     */
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
        /**
         * ✅ Donation Create
         */
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

        /**
         * ✅ Trees Logic
         */
        if ($validated['type'] === 'Trees') {

            foreach ($request->trees['type_id'] as $index => $typeId) {

                $qty = $request->trees['qty'][$index] ?? 0;
                if ($qty <= 0) continue;

                // FLOW = IN
                if ($validated['flow'] === 'In') {

                    for ($i = 0; $i < $qty; $i++) {
                        Tree::create([
                            'donation_id' => $donation->id,
                            'type_id'     => $typeId,
                            'project_id'  => $validated['project_id'],
                        ]);
                    }

                }
                // FLOW = OUT
                else {

                    $trees = Tree::where('project_id', $validated['project_id'])
                        ->where('type_id', $typeId)
                        ->whereNull('donation_id_out')
                        ->limit($qty)
                        ->get();

                    if ($trees->count() < $qty) {
                        throw new \Exception('Not enough trees available for OUT donation');
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

    $trees = Tree::where('donation_id', $donation->id)
        ->get()
        ->groupBy('type_id')
        ->map(function($group){
            return [
                'type_id' => $group[0]->type_id,
                'qty'     => $group->count(),
            ];
        });

    return view('admin.donation.edit', compact(
        'donation','users','projects','workshops','treetype','trees'
    ));
}


public function update(Request $request, Donation $donation)
{
    $request->validate([
        'user_id'    => 'required|exists:users,id',
        'project_id' => 'required|exists:projects,id',
        'ws_id'      => 'nullable|exists:work_shops,id',
        'type'       => 'required',
        'flow'       => 'required',
        'amount'     => 'required|numeric|min:1',

        'trees.type_id.*' => 'required_if:type,Trees|exists:tree_types,id',
        'trees.qty.*'     => 'required_if:type,Trees|numeric|min:1',
    ]);

    $donation->update([
        'user_id'    => $request->user_id,
        'project_id' => $request->project_id,
        'ws_id'      => $request->ws_id,
        'type'       => $request->type,
        'fund_type'  => $request->fund_type,
        'flow'       => $request->flow,
        'amount'     => $request->amount,
    ]);

    if ($request->type === 'Trees') {
        Tree::where('donation_id', $donation->id)
            ->where('project_id', $request->project_id)
            ->delete();

        $typeIds = array_values($request->trees['type_id'] ?? []);
        $qtys    = array_values($request->trees['qty'] ?? []);

        foreach ($typeIds as $i => $typeId) {
            $qty = isset($qtys[$i]) ? (int)$qtys[$i] : 0;
            if ($qty <= 0) continue;

            for ($j = 0; $j < $qty; $j++) {
                Tree::create([
                    'donation_id' => $donation->id,
                    'type_id'     => $typeId,
                    'project_id'  => $request->project_id,
                ]);
            }
        }

    } else {
        Tree::where('donation_id', $donation->id)->delete();
    }

    return redirect()->route('admin.donation.index')
        ->with('success','Donation updated successfully');
}

    public function destroy(Donation $donation)
    {
        $donation->delete();
        return redirect()->route('admin.donation.index')->with('success', 'Donation deleted successfully');
    }
}
