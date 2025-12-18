<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
 use App\Mail\AccountCreatedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
      public function create()
    {
        return view('admin.users.create');
    }

public function store(Request $request)
{
    // Validation rules
    $rules = [
        'name' => 'required|string|max:255',
        'password' => 'required|min:6',
        'role' => 'required|in:1,2',
    ];

    if ($request->role == 2) {
        // Company validation
        $rules += [
            'company_email' => 'required|email|unique:users,company_email',
            'company_phone' => 'required',
            'company_address' => 'required',
        ];
    } else {
        // User validation
        $rules += [
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
            'address' => 'required',
        ];
    }

    $validated = $request->validate($rules);

    // Plain password for email
    $plainPassword = $request->password;

    // Prepare data for DB
    $data = [
        'name' => $request->name,
        'password' => Hash::make($plainPassword),
        'role' => $request->role,
    ];

    if ($request->role == 2) {
        $data['company_email'] = $request->company_email;
        $data['company_phone'] = $request->company_phone;
        $data['company_address'] = $request->company_address;

        $mailTo = $request->company_email;
    } else {
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;

        $mailTo = $request->email;
    }

    $user = User::create($data);

    Mail::to($mailTo)->send(
        new AccountCreatedMail($user->name, $mailTo, $plainPassword)
    );

    return redirect()->route('admin.users.index')->with('success', 'User created & email sent successfully!');
}


public function index()
{
    $users = User::latest()->get();
    return view('admin.users.index', compact('users'));
}

public function edit(User $user)
{
    return view('admin.users.edit', compact('user'));
}

public function update(Request $request, User $user)
{
    $rules = [
        'name' => 'required|string|max:255',
        'role' => 'required|in:1,2',
    ];

    if ($request->role == 2) {
        $rules += [
            'company_email' => 'required|email|unique:users,company_email,' . $user->id,
            'company_phone' => 'required',
            'company_address' => 'required',
        ];
    } else {
        $rules += [
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required',
            'address' => 'required',
        ];
    }

    $validated = $request->validate($rules);

    $data = [
        'name' => $request->name,
        'role' => $request->role,
    ];

    if ($request->role == 2) {
        $data += [
            'company_email' => $request->company_email,
            'company_phone' => $request->company_phone,
            'company_address' => $request->company_address,
            'email' => null,
            'phone' => null,
            'address' => null,
        ];
    } else {
        $data += [
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'company_email' => null,
            'company_phone' => null,
            'company_address' => null,
        ];
    }

    $user->update($data);

    return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
}

public function destroy(User $user)
{
    $user->delete();
    return redirect()->back()->with('success', 'User deleted successfully');
}


}
