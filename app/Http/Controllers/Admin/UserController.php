<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = Profile::query();

        // Search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('company_name', 'like', "%{$search}%");
            });
        }

        // Role filter
        if ($request->filled('role') && in_array($request->role, ['client', 'vendor', 'architect'])) {
            $query->where('role', $request->role);
        }

        // Verification filter
        if ($request->filled('verified')) {
            $query->where('is_verified', $request->verified === 'yes');
        }

        $profiles = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        return view('admin.users', compact('profiles'));
    }

    public function toggleVerification($id)
    {
        $profile = Profile::findOrFail($id);
        $profile->is_verified = !$profile->is_verified;
        $profile->save();

        $status = $profile->is_verified ? 'verified' : 'unverified';
        return back()->with('success', "User '{$profile->name}' has been successfully {$status}.");
    }
}
