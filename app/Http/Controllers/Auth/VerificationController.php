<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Inertia\Response;

class VerificationController extends Controller
{
    /**
     * Display the verification code view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Verification', [
            'status' => session('status'),
        ]);
    }

    /**
     * Handle the verification code submission.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'code' => 'required|string|size:4|regex:/^[0-9]+$/',
        ]);

        // Get the stored code from session (this would be set when sending the code)
        $storedCode = Session::get('verification_code');
        $email = Session::get('verification_email');

        if (!$storedCode || !$email) {
            return back()->withErrors(['code' => 'Verification code has expired. Please request a new one.']);
        }

        if ($request->code === $storedCode) {
            // Clear the session data
            Session::forget(['verification_code', 'verification_email']);
            
            // Redirect to password reset page or success page
            return redirect()->route('password.reset', [
                'token' => Session::get('reset_token'),
                'email' => $email
            ])->with('status', 'Code verified successfully!');
        }

        return back()->withErrors(['code' => 'Invalid verification code. Please try again.']);
    }

    /**
     * Resend verification code.
     */
    public function resend(Request $request): RedirectResponse
    {
        $email = Session::get('verification_email');
        
        if (!$email) {
            return back()->withErrors(['email' => 'No email found. Please request a new password reset.']);
        }

        // Generate a new 4-digit code
        $code = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        
        // Store the new code in session
        Session::put('verification_code', $code);
        Session::put('verification_email', $email);

        // Here you would send the email with the new code
        // For now, we'll just return a success message
        // In production, you would use Laravel's Mail facade to send the code

        return back()->with('status', 'A new verification code has been sent to your email.');
    }
} 