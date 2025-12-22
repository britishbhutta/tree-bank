<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\User;
use App\Models\Work_Shop;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index()
    {
        $donations = Donation::with(['users','workshop'])->latest()->paginate(10);
        return view('admin.donation.index', compact('donations'));
    }

 // Show create form
    public function create()
    {
        $users = User::select('id','name')->get();
        $workshops = Work_Shop::select('id','name')->get();

        $lastDonation = Donation::latest('id')->first();
        $donationNumber = 'TB-' . str_pad($lastDonation ? $lastDonation->id + 1 : 1, 3, '0', STR_PAD_LEFT);

        return view('admin.donation.create', compact('users', 'workshops', 'donationNumber'));
    }


    public function store(Request $request)
    {
        $rules = [
            'user_id' => 'required|exists:users,id',
            'ws_id'   => 'required|exists:work_shops,id',
            'type'    => 'required|in:Trees,Funds',
            'amount'  => 'required|numeric',
            'flow'    => 'required|in:In,Out',
        ];

        if ($request->type === 'Funds') {
            $rules['fund_type'] = 'required|in:Cash,Cheque';
        }

        $validated = $request->validate($rules);

        $lastDonation = Donation::latest('id')->first();
        $donationNumber = 'TB-' . str_pad($lastDonation ? $lastDonation->id + 1 : 1, 3, '0', STR_PAD_LEFT);

        Donation::create([
            'user_id'   => $validated['user_id'],
            'ws_id'     => $validated['ws_id'],
            'type'      => $validated['type'],
            'amount'    => $validated['amount'],
            'fund_type' => $request->type === 'Funds' ? $validated['fund_type'] : null,
            'flow'      => $validated['flow'],
            'donation_number' => $donationNumber,
        ]);

        return redirect()->route('admin.donation.create')
                        ->with('success', "Donation created successfully with number $donationNumber");
        }

   public function edit(Donation $donation)
{
    $users = User::select('id','name')->get();
    $workshops = Work_Shop::select('id','name')->get();

    return view('admin.donation.edit', compact('donation','users','workshops'));
}

public function update(Request $request, Donation $donation)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'ws_id' => 'required|exists:work_shops,id',
        'type' => 'required|in:Trees,Funds',
        'amount' => 'required|numeric',
        'fund_type' => $request->type === 'Funds' ? 'required|in:Cash,Cheque' : 'nullable',
        'flow' => 'required|in:In,Out',
        'donation_number' => 'required|string|max:255|unique:donations,donation_number,' . $donation->id,
    ]);

    $donation->update([
        'user_id' => $request->user_id,
        'ws_id' => $request->ws_id,
        'type' => $request->type,
        'amount' => $request->amount,
        'fund_type' => $request->type === 'Funds' ? $request->fund_type : null,
        'flow' => $request->flow,
        'donation_number' => $request->donation_number,
    ]);

    return redirect()->route('admin.donation.index')->with('success', 'Donation updated successfully');
}


    public function destroy(Donation $donation)
    {
        $donation->delete();
        return redirect()->route('admin.donation.index')->with('success', 'Donation deleted successfully');
    }
}
