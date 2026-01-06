<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Contact_Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactUsController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
        'name'    => 'required|string|min:3|max:100',
        'email'   => 'required|email',
        'subject' => 'nullable|string|max:150',
        'message' => 'required|string|min:10',
    ]);
    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'errors' => $validator->errors(),
        ], 422);
    }
    $validated = $validator->validated();
    Contact_Message::create([
        'name'    => $validated['name'],
        'email'   => $validated['email'],
        'subject' => $validated['subject'] ?? null,
        'message' => $validated['message'],
        'user_id' => auth()->id(),  
    ]);
    return response()->json([
        'success' => true,
        'message' => 'We have received your message. We will contact you within 24 hours.',
    ]);
    }
}
