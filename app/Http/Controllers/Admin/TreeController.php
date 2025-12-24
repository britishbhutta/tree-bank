<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

}
