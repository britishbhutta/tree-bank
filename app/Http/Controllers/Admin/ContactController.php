<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact_Message;

class ContactController extends Controller
{
    public function contact(){
        $contacts = Contact_Message::latest()->get();
        return view('admin.contact.index', compact('contacts'));
    }

    public function destroyContact($id){
        Contact_Message::findOrFail($id)->delete();

        return redirect()
            ->route('admin.contact.index')
            ->with('success', 'Contact message deleted successfully.');
    }
}
