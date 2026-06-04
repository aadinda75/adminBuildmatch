@extends('admin.layouts.main')

@section('title', 'Dashboard')
@section('header_title', 'Dashboard Overview')

@section('content')
    <!-- Stats Cards Grid -->
    <div class="stats-grid">
        <div class="stats-card">
            <div class="stats-info">
                <h3>{{ $totalUsers }}</h3>
                <p>Total Registered Profiles</p>
                <div style="font-size: 0.75rem; color: var(--text-secondary); margin-top: 4px;">
                    Clients: {{ $clientCount }} | Kontraktor: {{ $vendorCount }} | Arsitek: {{ $architectCount }}
                </div>
            </div>
            <div class="stats-icon blue">
                <i class='bx bx-group'></i>
            </div>
        </div>

        <div class="stats-card">
            <div class="stats-info">
                <h3>{{ $totalProjects }}</h3>
                <p>Total Projects Created</p>
                <div style="font-size: 0.75rem; color: var(--text-secondary); margin-top: 4px;">
                    Open: {{ $openProjects }} | Active: {{ $activeProjects }} | Done: {{ $completedProjects }}
                </div>
            </div>
            <div class="stats-icon purple">
                <i class='bx bx-briefcase'></i>
            </div>
        </div>

        <div class="stats-card">
            <div class="stats-info">
                <h3>Rp {{ number_format($totalContractValue, 0, ',', '.') }}</h3>
                <p>Total Contract Volume</p>
                <div style="font-size: 0.75rem; color: var(--text-secondary); margin-top: 4px;">
                    From {{ $activeContractsCount }} Active Contracts
                </div>
            </div>
            <div class="stats-icon green">
                <i class='bx bx-wallet'></i>
            </div>
        </div>

        <div class="stats-card">
            <div class="stats-info">
                <h3>{{ $pendingPayments->count() }}</h3>
                <p>Pending Milestones</p>
                <div style="font-size: 0.75rem; color: var(--text-secondary); margin-top: 4px;">
                    Awaiting progress reviews
                </div>
            </div>
            <div class="stats-icon orange">
                <i class='bx bx-time-five'></i>
            </div>
        </div>
    </div>

    <!-- Charts & Analytics -->
    <div class="dashboard-grid">
        <div class="content-card">
            <div class="card-header">
                <h2 class="card-title">Ecosystem Distribution</h2>
            </div>
            <div style="height: 300px; display: flex; gap: 20px;">
                <div style="flex: 1; position: relative;">
                    <canvas id="userRolesChart"></canvas>
                </div>
                <div style="flex: 1; position: relative;">
                    <canvas id="projectStatusChart"></canvas>
                </div>
            </div>
        </div>

        <div class="content-card">
            <div class="card-header">
                <h2 class="card-title">Pending Milestone Verifications</h2>
                <a href="{{ route('admin.payments.index', ['status' => 'pending']) }}" class="btn btn-outline btn-sm">View All</a>
            </div>
            <div class="table-responsive">
                @if($pendingPayments->isEmpty())
                    <p style="color: var(--text-muted); text-align: center; padding: 20px 0;">No pending progress verifications.</p>
                @else
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Project</th>
                                <th>Milestone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendingPayments as $payment)
                                <tr>
                                    <td><strong>{{ Str::limit($payment->project->title ?? 'N/A', 15) }}</strong></td>
                                    <td>{{ Str::limit($payment->name, 15) }}</td>
                                    <td>
                                        <a href="{{ route('admin.payments.index') }}?search={{ urlencode($payment->project->title ?? '') }}" class="btn btn-primary btn-sm">
                                            Verify
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

    <!-- Lists Grid -->
    <div class="dashboard-grid">
        <div class="content-card">
            <div class="card-header">
                <h2 class="card-title">Recent Projects</h2>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-outline btn-sm">View All</a>
            </div>
            <div class="table-responsive">
                @if($recentProjects->isEmpty())
                    <p style="color: var(--text-muted); text-align: center; padding: 20px 0;">No projects created yet.</p>
                @else
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Client</th>
                                <th>Budget</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentProjects as $project)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.projects.show', $project->id) }}" style="color: #2563eb; font-weight: 500; text-decoration: none;">
                                            {{ Str::limit($project->title, 25) }}
                                        </a>
                                    </td>
                                    <td>{{ $project->client->name ?? 'Unknown Client' }}</td>
                                    <td>Rp {{ number_format($project->budget, 0, ',', '.') }}</td>
                                    <td><span class="badge {{ $project->status }}">{{ $project->status }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

        <div class="content-card">
            <div class="card-header">
                <h2 class="card-title">Recent Registered Profiles</h2>
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline btn-sm">View All</a>
            </div>
            <div class="table-responsive">
                @if($recentUsers->isEmpty())
                    <p style="color: var(--text-muted); text-align: center; padding: 20px 0;">No users registered yet.</p>
                @else
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentUsers as $user)
                                <tr>
                                    <td>
                                        <div style="font-weight: 500;">{{ $user->name ?? 'Unnamed' }}</div>
                                        <div style="font-size: 0.75rem; color: var(--text-secondary);">
                                            {{ $user->company_name ?? 'Individual' }}
                                        </div>
                                    </td>
                                    <td>
                                        @if($user->role === 'client')
                                            <span class="badge client">Client</span>
                                        @elseif($user->role === 'architect')
                                            <span class="badge architect">Arsitek</span>
                                        @elseif($user->role === 'vendor')
                                            <span class="badge vendor">Kontraktor</span>
                                        @else
                                            <span class="badge">{{ $user->role }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Roles Distribution Chart
        const rolesCtx = document.getElementById('userRolesChart').getContext('2d');
        new Chart(rolesCtx, {
            type: 'bar',
            data: {
                labels: ['Client', 'Kontraktor', 'Arsitek'],
                datasets: [{
                    label: 'User Registrations',
                    data: [{{ $clientCount }}, {{ $vendorCount }}, {{ $architectCount }}],
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.6)',
                        'rgba(139, 92, 246, 0.6)',
                        'rgba(249, 115, 22, 0.6)'
                    ],
                    borderColor: [
                        'rgba(59, 130, 246, 1)',
                        'rgba(139, 92, 246, 1)',
                        'rgba(249, 115, 22, 1)'
                    ],
                    borderWidth: 1,
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0, 0, 0, 0.05)' },
                        ticks: { color: '#475569', font: { family: 'Outfit' } }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: '#475569', font: { family: 'Outfit' } }
                    }
                }
            }
        });

        // Project Status Chart
        const projectCtx = document.getElementById('projectStatusChart').getContext('2d');
        new Chart(projectCtx, {
            type: 'doughnut',
            data: {
                labels: ['Open', 'Active', 'Completed', 'Cancelled'],
                datasets: [{
                    data: [{{ $openProjects }}, {{ $activeProjects }}, {{ $completedProjects }}, {{ $cancelledProjects }}],
                    backgroundColor: [
                        '#3b82f6',
                        '#f59e0b',
                        '#10b981',
                        '#ef4444'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            color: '#475569',
                            font: { family: 'Outfit', size: 12 }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
