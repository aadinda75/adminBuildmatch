<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - BuildMatch Admin</title>
    <!-- Boxicons CDN -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
    @yield('styles')
</head>
<body>
    <!-- Blurry Background Circles -->
    <div class="bg-blob bg-blob-1"></div>
    <div class="bg-blob bg-blob-2"></div>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <span class="sidebar-brand">BuildMatch</span>
        </div>
        
        <ul class="sidebar-menu">
            <li class="menu-item {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class='bx bx-grid-alt'></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="menu-item {{ Request::routeIs('admin.users.index') ? 'active' : '' }}">
                <a href="{{ route('admin.users.index') }}">
                    <i class='bx bx-user'></i>
                    <span>Profiles</span>
                </a>
            </li>
            <li class="menu-item {{ Request::routeIs('admin.projects.index') || Request::routeIs('admin.projects.show') ? 'active' : '' }}">
                <a href="{{ route('admin.projects.index') }}">
                    <i class='bx bx-folder'></i>
                    <span>Projects</span>
                </a>
            </li>
            <li class="menu-item {{ Request::routeIs('admin.payments.index') ? 'active' : '' }}">
                <a href="{{ route('admin.payments.index') }}">
                    <i class='bx bx-credit-card'></i>
                    <span>Payments</span>
                </a>
            </li>
        </ul>

        <div class="sidebar-footer">
            <div class="user-profile-summary">
                <div class="user-avatar">
                    {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                </div>
                <div class="user-info">
                    <div class="user-name">{{ Auth::user()->name ?? 'Admin' }}</div>
                    <div class="user-role">Administrator</div>
                </div>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-logout" title="Sign Out">
                        <i class='bx bx-log-out'></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <!-- Header -->
        <header class="main-header">
            <h1 class="page-title">@yield('header_title')</h1>
            <div class="header-actions">
                <div style="font-size: 0.88rem; color: var(--text-secondary);">
                    Logged in as: <strong>{{ Auth::user()->email ?? 'admin@buildmatch.com' }}</strong>
                </div>
            </div>
        </header>

        <!-- Content Body -->
        <main class="content-body">
            <!-- Flash Alerts -->
            @if(session('success'))
                <div class="alert alert-success">
                    <i class='bx bx-check-circle' style="font-size: 1.2rem;"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('warning'))
                <div class="alert alert-warning">
                    <i class='bx bx-error-circle' style="font-size: 1.2rem;"></i>
                    <span>{{ session('warning') }}</span>
                </div>
            @endif

            <!-- Main Content Yield -->
            @yield('content')
        </main>
    </div>

    @yield('scripts')
</body>
</html>
