<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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
    $rules = [
        'name' => 'required|string|max:255',
        'password' => 'required|string|min:6',
        'role' => 'required|in:1,2,3,4,5',
        'department' => 'nullable|string|max:255',

        'city' => 'nullable|string|max:255',
        'district' => 'nullable|string|max:255',
        'tehsil' => 'nullable|string|max:255',

        'company_city' => 'nullable|string|max:255',
        'company_district' => 'nullable|string|max:255',
        'company_tehsil' => 'nullable|string|max:255',
    ];

    if ($request->role == 2) {
        $rules += [
            'company_email' => 'required|email|unique:users,company_email',
            'company_phone' => 'required|string',
            'company_address' => 'required|string',
        ];
    } else {
        $rules += [
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string',
            'address' => 'required|string',
        ];
    }

    $validated = $request->validate($rules);

    $plainPassword = $request->password;

    $data = [
        'name' => $request->name,
        'password' => Hash::make($plainPassword),
        'role' => $request->role,
        'department' => $request->department,

        'city' => $request->city,
        'district' => $request->district,
        'tehsil' => $request->tehsil,

        'company_city' => $request->company_city,
        'company_district' => $request->company_district,
        'company_tehsil' => $request->company_tehsil,
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

    return redirect()->route('admin.users.index')
        ->with('success', 'User created & email sent successfully!');
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
        'role' => 'required|in:1,2,3,4,5',
        'department' => 'nullable|string|max:255',

        'city' => 'nullable|string|max:255',
        'district' => 'nullable|string|max:255',
        'tehsil' => 'nullable|string|max:255',

        'company_city' => 'nullable|string|max:255',
        'company_district' => 'nullable|string|max:255',
        'company_tehsil' => 'nullable|string|max:255',
    ];

    if ($request->role == 2) {
        // Company
        $rules += [
            'company_email' => [
                'required',
                'email',
                Rule::unique('users', 'company_email')->ignore($user->id),
            ],
            'company_phone' => 'required|string',
            'company_address' => 'required|string',
        ];
    } else {
        // Personal
        $rules += [
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'phone' => 'required|string',
            'address' => 'required|string',
        ];
    }

    $validated = $request->validate($rules);

    $data = [
        'name' => $request->name,
        'role' => $request->role,
        'department' => $request->department,

        'city' => $request->city,
        'district' => $request->district,
        'tehsil' => $request->tehsil,

        'company_city' => $request->company_city,
        'company_district' => $request->company_district,
        'company_tehsil' => $request->company_tehsil,
    ];

    if ($request->role == 2) {
        // Company data
        $data += [
            'company_email' => $request->company_email,
            'company_phone' => $request->company_phone,
            'company_address' => $request->company_address,
        ];
    } else {
        // Personal data
        $data += [
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ];
    }

    $user->update($data);

    return redirect()
        ->route('admin.users.index')
        ->with('success', 'User updated successfully');
}


// public function update(Request $request, User $user)
// {
//     $rules = [
//         'name' => 'required|string|max:255',
//         'role' => 'required|in:1,2,3,4',
//     ];

//     if ($request->role == 2) {
//         $rules += [
//             'company_email' => 'required|email|unique:users,company_email,' . $user->id,
//             'company_phone' => 'required',
//             'company_address' => 'required',
//         ];
//     } else {
//         $rules += [
//             'email' => 'required|email|unique:users,email,' . $user->id,
//             'phone' => 'required',
//             'address' => 'required',
//         ];
//     }

//     $validated = $request->validate($rules);

//     $data = [
//         'name' => $request->name,
//         'role' => $request->role,
//     ];

//     if ($request->role == 2) {
//         $data += [
//             'company_email' => $request->company_email,
//             'company_phone' => $request->company_phone,
//             'company_address' => $request->company_address,
//             'email' => null,
//             'phone' => null,
//             'address' => null,
//         ];
//     } else {
//         $data += [
//             'email' => $request->email,
//             'phone' => $request->phone,
//             'address' => $request->address,
//             'company_email' => null,
//             'company_phone' => null,
//             'company_address' => null,
//         ];
//     }

//     $user->update($data);

//     return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
// }

public function destroy(User $user)
{
    $user->delete();
    return redirect()->back()->with('success', 'User deleted successfully');
}


}
