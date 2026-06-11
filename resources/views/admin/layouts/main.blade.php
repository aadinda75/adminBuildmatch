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
        <div class="sidebar-header" style="display: flex; align-items: center; gap: 10px;">
            <div style="width: 32px; height: 32px; border-radius: 8px; background: #8C2B0B; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <svg width="22" height="22" viewBox="0 0 192 192" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_sidebar)">
                        <path d="M78.3518 44.3721C82.0099 44.6681 85.6302 43.4573 88.3741 41.02L101.045 29.765C104.064 27.0835 108.685 27.357 111.367 30.3759L113.037 32.2559C114.796 34.2365 114.616 37.2684 112.636 39.0277C109.481 41.8297 111.22 47.046 115.425 47.3944L133.534 48.8951C140.23 49.45 145.307 55.1713 145.062 61.8862L142.763 124.842C142.636 128.339 139.617 131.024 136.128 130.741C132.85 130.476 130.362 127.675 130.485 124.388L132.067 82.1701C132.508 70.3985 123.599 60.3682 111.858 59.4178L69.751 56.0096C66.4705 55.744 63.9812 52.9416 64.1045 49.6527C64.2356 46.156 67.255 43.474 70.7428 43.7562L78.3518 44.3721Z" fill="#FEFBF9"/>
                        <path d="M52.5684 144.206C53.4872 145.24 54.7818 145.858 56.1646 145.928C57.5475 145.993 58.8966 145.496 59.9085 144.558L113.377 94.8379C118.297 90.2627 118.663 82.596 114.201 77.5728C109.739 72.5496 102.082 72.0089 96.9587 76.3553L41.2812 123.588C40.2278 124.479 39.5785 125.763 39.4792 127.144C39.383 128.522 39.8465 129.884 40.7627 130.915L52.5684 144.206Z" fill="#FEFBF9"/>
                    </g>
                    <defs><clipPath id="clip0_sidebar"><rect width="135.342" height="135.342" fill="white" transform="translate(101.189) rotate(48.3871)"/></clipPath></defs>
                </svg>
            </div>
            <span class="sidebar-brand"><span style="color: #8C2B0B;">Build</span><span style="color: #111;">Match</span></span>
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
                <button type="button" class="btn-logout" title="Sign Out" onclick="document.getElementById('logoutModal').classList.add('show')">
                    <i class='bx bx-log-out'></i>
                </button>
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

    <!-- ======= LOGOUT CONFIRMATION MODAL ======= -->
    <div id="logoutModal" style="
        display: none;
        position: fixed; inset: 0; z-index: 9999;
        background: rgba(0,0,0,0.35);
        backdrop-filter: blur(4px);
        align-items: center;
        justify-content: center;
    " onclick="if(event.target===this) this.classList.remove('show')">
        <div style="
            background: #fff;
            border-radius: 20px;
            padding: 36px 32px 28px;
            max-width: 380px;
            width: 90%;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
            animation: popIn 0.25s cubic-bezier(0.175,0.885,0.32,1.275) both;
        ">
            <!-- Icon -->
            <div style="
                width: 60px; height: 60px; border-radius: 50%;
                background: rgba(140,43,11,0.08);
                display: flex; align-items: center; justify-content: center;
                margin: 0 auto 18px;
            ">
                <i class='bx bx-log-out' style="font-size: 1.8rem; color: #8C2B0B;"></i>
            </div>
            <h3 style="font-size: 1.15rem; font-weight: 700; color: #3E2723; margin-bottom: 8px;">Keluar dari Akun?</h3>
            <p style="font-size: 0.88rem; color: #666; margin-bottom: 28px; line-height: 1.5;">
                Anda akan keluar dari sesi Admin BuildMatch ini. Pastikan semua pekerjaan sudah disimpan.
            </p>
            <div style="display: flex; gap: 10px;">
                <!-- Cancel -->
                <button onclick="document.getElementById('logoutModal').classList.remove('show')"
                    style="
                        flex: 1; padding: 12px; border-radius: 12px;
                        border: 1px solid #EBCAB6; background: #fff;
                        color: #8C2B0B; font-weight: 600; font-size: 0.9rem;
                        cursor: pointer; transition: all 0.2s ease;
                    "
                    onmouseover="this.style.background='#F8F5F2'"
                    onmouseout="this.style.background='#fff'">
                    Batal
                </button>
                <!-- Confirm logout -->
                <form action="{{ route('logout') }}" method="POST" style="flex: 1;">
                    @csrf
                    <button type="submit" style="
                        width: 100%; padding: 12px; border-radius: 12px;
                        border: none; background: linear-gradient(135deg,#8C2B0B,#732309);
                        color: #fff; font-weight: 600; font-size: 0.9rem;
                        cursor: pointer; transition: all 0.2s ease;
                    "
                    onmouseover="this.style.opacity='0.88'"
                    onmouseout="this.style.opacity='1'">
                        Ya, Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <style>
        #logoutModal.show { display: flex !important; }
        @keyframes popIn {
            from { opacity: 0; transform: scale(0.88); }
            to   { opacity: 1; transform: scale(1); }
        }
    </style>

    <script>
        // Auto-hide flash alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(function(alert) {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(function() {
                        alert.style.display = 'none';
                        alert.remove();
                    }, 500);
                });
            }, 5000);
        });
    </script>
    @yield('scripts')
</body>
</html>
