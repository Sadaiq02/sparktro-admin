<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SuccessController extends Controller
{
    /**
     * Display the password reset success view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Successful', [
            'status' => session('status'),
        ]);
    }
} 