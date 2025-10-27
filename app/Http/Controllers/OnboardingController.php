<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class OnboardingController extends Controller
{
    /**
     * Display the onboarding page
     */
    public function index()
    {
        // If the application is already installed, redirect to login page
        if (Setting::isInstalled()) {
            return redirect('/admin/login');
        }

        return view('onboarding.index');
    }

    /**
     * Create the first administrator user
     */
    public function store(Request $request)
    {
        // Verify that the application is not already installed
        if (Setting::isInstalled()) {
            return redirect('/admin/login')->with('error', __('onboarding.errors.already_installed'));
        }

        // Validate the data
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        // Create the administrator user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Mark the application as installed
        Setting::markAsInstalled();

        // Automatically log in the user
        Auth::login($user);

        return redirect('/admin/login')->with('success', __('onboarding.success'));
    }
}
