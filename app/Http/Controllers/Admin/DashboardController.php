<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Contract;
use App\Models\PaymentTerm;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Calculate Profile statistics
        $clientCount = Profile::where('role', 'client')->count();
        $vendorCount = Profile::where('role', 'vendor')->count();
        $architectCount = Profile::where('role', 'architect')->count();
        $totalUsers = $clientCount + $vendorCount + $architectCount;

        // Calculate Project statistics
        $totalProjects = Project::count();
        $openProjects = Project::where('status', 'open')->count();
        $activeProjects = Project::where('status', 'in_progress')->count();
        $completedProjects = Project::where('status', 'completed')->count();
        $cancelledProjects = Project::where('status', 'cancelled')->count();

        // Calculate Contract statistics
        $totalContractValue = Contract::where('status', 'active')->orWhere('status', 'completed')->sum('total_price');
        $activeContractsCount = Contract::where('status', 'active')->count();

        // Fetch recent projects
        $recentProjects = Project::with('client')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Fetch recent registered users
        $recentUsers = Profile::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Fetch pending milestone verifications
        $pendingPayments = PaymentTerm::with(['project', 'vendor'])
            ->whereNotNull('progress_submitted_at')
            ->where('status', 'pending')
            ->orderBy('progress_submitted_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'clientCount',
            'vendorCount',
            'architectCount',
            'totalUsers',
            'totalProjects',
            'openProjects',
            'activeProjects',
            'completedProjects',
            'cancelledProjects',
            'totalContractValue',
            'activeContractsCount',
            'recentProjects',
            'recentUsers',
            'pendingPayments'
        ));
    }
}
