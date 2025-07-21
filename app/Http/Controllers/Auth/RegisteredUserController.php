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
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

use Illuminate\Support\Facades\Session;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */


    public function store(Request $request): RedirectResponse
    {
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'copy_id' => ['required', 'string', 'max:50', 'unique:users'],
               'project_name' => ['required', 'in:Frontier,CCI'],
            'registration_date' => ['required', 'date'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'copy_id' => $request->copy_id,
              'project_name' => $request->project_name,
            'registration_date' => $request->registration_date,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 0,
            'blocked' => 0,
        ]);

        event(new Registered($user));

        // Assign 'user' role
        $userRole = Role::firstOrCreate(['name' => 'user']);
        $user->assignRole($userRole);

        // Check role and status
        if ($user->hasRole('user') && $user->status === 0) {
            return redirect()->route('register')->with('success', '🎉 Your account has been created successfully! Please wait for admin approval before logging in.');
        }

        // If approved immediately, log them in
        Auth::login($user);

        return redirect(route('dashboard'))->with('success', '🎉 Welcome! You have been successfully registered and logged in.');
    }
}
