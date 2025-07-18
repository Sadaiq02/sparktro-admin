<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class RolePermissionController extends Controller
{
    public function roles()
    {
        return Inertia::render('RolePermission/Role');
    }

    public function assign()
    {
        return Inertia::render('RolePermission/Assign');
    }
} 