@extends('admin.layouts.main')

@section('title', 'User Profiles')
@section('header_title', 'User Profiles Management')

@section('content')
    <!-- Filters above the data card (minimalist light styling) -->
    <form action="{{ route('admin.users.index') }}" method="GET" class="filter-row">
        <div class="form-search">
            <i class='bx bx-search'></i>
            <input type="text" name="search" placeholder="Search by name, phone, or company..." value="{{ request('search') }}">
        </div>
        
        <select name="role" class="select-filter" onchange="this.form.submit()">
            <option value="">All Roles</option>
            <option value="client" {{ request('role') == 'client' ? 'selected' : '' }}>Client</option>
            <option value="architect" {{ request('role') == 'architect' ? 'selected' : '' }}>Arsitek</option>
            <option value="vendor" {{ request('role') == 'vendor' ? 'selected' : '' }}>Kontraktor</option>
        </select>

        <select name="verified" class="select-filter" onchange="this.form.submit()">
            <option value="">All Verification Status</option>
            <option value="yes" {{ request('verified') == 'yes' ? 'selected' : '' }}>Verified Only</option>
            <option value="no" {{ request('verified') == 'no' ? 'selected' : '' }}>Unverified Only</option>
        </select>

        <button type="submit" class="btn btn-primary">Filter</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline">Reset</a>
    </form>

    <!-- Data Card containing profiles list -->
    <div class="content-card">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Profile Details</th>
                        <th>Role</th>
                        <th>Professional Info</th>
                        <th>Verification</th>
                        <th>Registered At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($profiles as $profile)
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <div class="user-avatar" style="width: 36px; height: 36px; font-size: 0.85rem;">
                                        @if($profile->avatar_url)
                                            <img src="{{ $profile->avatar_url }}" alt="avatar" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                                        @else
                                            {{ strtoupper(substr($profile->name ?? 'U', 0, 1)) }}
                                        @endif
                                    </div>
                                    <div>
                                        <div style="font-weight: 500;">{{ $profile->name ?? 'Unnamed' }}</div>
                                        <div style="font-size: 0.78rem; color: var(--text-secondary);">{{ $profile->phone ?? 'No phone' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($profile->role === 'client')
                                    <span class="badge client">Client</span>
                                @elseif($profile->role === 'architect')
                                    <span class="badge architect">Arsitek</span>
                                @elseif($profile->role === 'vendor')
                                    <span class="badge vendor">Kontraktor</span>
                                @else
                                    <span class="badge">{{ $profile->role }}</span>
                                @endif
                            </td>
                            <td>
                                @if($profile->role === 'vendor' || $profile->role === 'architect')
                                    <div style="font-weight: 500;">{{ $profile->company_name ?? 'Individual Contractor' }}</div>
                                    <div style="font-size: 0.75rem; color: var(--text-secondary); margin-top: 2px;">
                                        NIB: {{ $profile->nib ?? 'N/A' }} | NPWP: {{ $profile->npwp ?? 'N/A' }}
                                    </div>
                                    @if($profile->stra_number)
                                        <div style="font-size: 0.75rem; color: var(--text-secondary);">
                                            STRA: {{ $profile->stra_number }}
                                        </div>
                                    @endif
                                    <div style="font-size: 0.75rem; color: var(--text-secondary);">
                                        Exp: {{ $profile->experience_years ?? '0' }} Years
                                    </div>
                                @else
                                    <div style="color: var(--text-muted); font-style: italic; font-size: 0.85rem;">N/A (Client Profile)</div>
                                @endif
                            </td>
                            <td>
                                @if($profile->is_verified)
                                    <span class="badge verified">
                                        <i class='bx bx-check-shield' style="margin-right: 4px;"></i> Verified
                                    </span>
                                @else
                                    <span class="badge unverified">
                                        <i class='bx bx-error-shield' style="margin-right: 4px;"></i> Unverified
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div style="font-size: 0.85rem;">{{ $profile->created_at ? $profile->created_at->format('d M Y') : 'N/A' }}</div>
                            </td>
                            <td>
                                @if($profile->role === 'vendor' || $profile->role === 'architect')
                                    @if($profile->is_verified)
                                        <button type="button" class="btn btn-danger btn-sm" onclick="openVerifyModal('{{ route('admin.users.verify', $profile->id) }}', '{{ addslashes($profile->name) }}', false)">
                                            <i class='bx bx-x-circle'></i> Unverify
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-success btn-sm" onclick="openVerifyModal('{{ route('admin.users.verify', $profile->id) }}', '{{ addslashes($profile->name) }}', true)">
                                            <i class='bx bx-check-circle'></i> Verify
                                        </button>
                                    @endif
                                @else
                                    <span style="color: var(--text-muted); font-size: 0.8rem; font-style: italic;">No actions</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; color: var(--text-muted); padding: 30px;">
                                No user profiles found matching filters.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-wrapper">
            {{ $profiles->links() }}
        </div>
    </div>

    <!-- ======= VERIFY CONFIRMATION MODAL ======= -->
    <div id="verifyModal" style="
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
            <div id="verifyModalIconBg" style="
                width: 60px; height: 60px; border-radius: 50%;
                background: rgba(46, 204, 113, 0.1);
                display: flex; align-items: center; justify-content: center;
                margin: 0 auto 18px;
            ">
                <i id="verifyModalIcon" class='bx bx-check-shield' style="font-size: 1.8rem; color: #2ecc71;"></i>
            </div>
            <h3 id="verifyModalTitle" style="font-size: 1.15rem; font-weight: 700; color: #3E2723; margin-bottom: 8px;">Verifikasi User?</h3>
            <p id="verifyModalText" style="font-size: 0.88rem; color: #666; margin-bottom: 28px; line-height: 1.5;">
                Apakah Anda yakin untuk melakukan aksi ini?
            </p>
            <div style="display: flex; gap: 10px;">
                <!-- Cancel -->
                <button type="button" onclick="document.getElementById('verifyModal').classList.remove('show')"
                    style="
                        flex: 1; padding: 12px; border-radius: 12px;
                        border: 1px solid #ddd; background: #fff;
                        color: #666; font-weight: 600; font-size: 0.9rem;
                        cursor: pointer; transition: all 0.2s ease;
                    "
                    onmouseover="this.style.background='#f5f5f5'"
                    onmouseout="this.style.background='#fff'">
                    Batal
                </button>
                <!-- Confirm -->
                <form id="verifyModalForm" action="" method="POST" style="flex: 1;">
                    @csrf
                    <button id="verifyModalBtn" type="submit" style="
                        width: 100%; padding: 12px; border-radius: 12px;
                        border: none; background: #2ecc71;
                        color: #fff; font-weight: 600; font-size: 0.9rem;
                        cursor: pointer; transition: all 0.2s ease;
                    "
                    onmouseover="this.style.opacity='0.88'"
                    onmouseout="this.style.opacity='1'">
                        Ya, Lanjutkan
                    </button>
                </form>
            </div>
        </div>
    </div>

    <style>
        #verifyModal.show { display: flex !important; }
    </style>

    <script>
        function openVerifyModal(actionUrl, userName, isVerifying) {
            const modal = document.getElementById('verifyModal');
            const form = document.getElementById('verifyModalForm');
            const title = document.getElementById('verifyModalTitle');
            const text = document.getElementById('verifyModalText');
            const iconBg = document.getElementById('verifyModalIconBg');
            const icon = document.getElementById('verifyModalIcon');
            const btn = document.getElementById('verifyModalBtn');

            // Set Form Action
            form.action = actionUrl;

            if (isVerifying) {
                title.textContent = 'Verifikasi User?';
                text.textContent = 'Apakah Anda yakin untuk memverifikasi ' + userName + '?';
                iconBg.style.background = 'rgba(140, 43, 11, 0.1)';
                icon.className = 'bx bx-check-shield';
                icon.style.color = '#8C2B0B';
                btn.style.background = '#8C2B0B';
                btn.textContent = 'Ya, Verify';
            } else {
                title.textContent = 'Unverify User?';
                text.textContent = 'Apakah Anda yakin untuk unverify ' + userName + '?';
                iconBg.style.background = 'rgba(140, 43, 11, 0.1)';
                icon.className = 'bx bx-x-circle';
                icon.style.color = '#8C2B0B';
                btn.style.background = '#8C2B0B';
                btn.textContent = 'Ya, Unverify';
            }

            modal.classList.add('show');
        }
    </script>
@endsection
