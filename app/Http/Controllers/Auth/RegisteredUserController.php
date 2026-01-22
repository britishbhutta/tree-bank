<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Validator;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'address' => 'required',
            // 'city' => 'required',
            'tehsil' => 'required',
            'district' => 'required',
            'role' => 'required|in:1,2',
            'company_name' => 'required_if:role,2',
            'company_email' => 'required_if:role,2',
            'company_phone' => 'required_if:role,2',
            'department' => 'required_if:role,2',
            'company_address' => 'required_if:role,2',
            // 'company_city' => 'required_if:role,2',
            'company_tehsil' => 'required_if:role,2',
            'company_district' => 'required_if:role,2',
        ],
        [
            'name.required' => 'Name is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already registered.',

            'password.required' => 'Password is required.',
            'password.confirmed' => 'Password confirmation does not match.',

            'role.required' => 'Please select a role.',
            'role.in' => 'Invalid role selected.',

            'company_name.required_if' => 'Company name is required.',
            'company_email.required_if' => 'Company email is required.',
            'company_phone.required_if' => 'Company phone is required.',
            'department.required_if' => 'Department is required.',
            'company_address.required_if' => 'Company Address is required.',
            // 'company_city.required_if' => 'Company City is required.',
            'company_tehsil.required_if' => 'Company Tehsil is required.',
            'company_district.required_if' => 'Company District is required.',
        ]
        );

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        // ]);

        // event(new Registered($user));
        

        $validated = $validator->validated();

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);
        Auth::login($user);
        return response()->json([
            'success' => true,
            'message' => 'Your Account has been Created and You have been Logged In.'
            ]);
    }

}
