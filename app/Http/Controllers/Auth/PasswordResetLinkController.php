<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Session;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/ForgotPassword', [
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Generate a 4-digit verification code
        $code = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        
        // Store the code and email in session
        Session::put('verification_code', $code);
        Session::put('verification_email', $request->email);

        // Here you would send the email with the verification code
        // For now, we'll just redirect to the verification page
        // In production, you would use Laravel's Mail facade to send the code

        return redirect()->route('verification.create')
            ->with('status', 'A 4-digit verification code has been sent to your email.');
    }
}
