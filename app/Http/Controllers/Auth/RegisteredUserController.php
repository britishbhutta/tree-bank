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
            'city' => 'required',
            'tehsil' => 'required',
            'district' => 'required',
            'account_type' => 'required|in:individual,company',
            'company_name' => 'required_if:account_type,company',
            'company_email' => 'required_if:account_type,company|email',
            'company_phone' => 'required_if:account_type,company',
            'department' => 'required_if:account_type,company',
            'company_address' => 'required_if:account_type,company',
            'company_city' => 'required_if:account_type,company',
            'company_tehsil' => 'required_if:account_type,company',
            'company_district' => 'required_if:account_type,company',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        // Auth::login($user);

        return response()->json(['success' => true]);
    }

}
