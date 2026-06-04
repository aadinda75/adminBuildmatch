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
                                    <form action="{{ route('admin.users.verify', $profile->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @if($profile->is_verified)
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to remove verification for {{ $profile->name }}?')">
                                                <i class='bx bx-x-circle'></i> Unverify
                                            </button>
                                        @else
                                            <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to verify {{ $profile->name }}?')">
                                                <i class='bx bx-check-circle'></i> Verify
                                            </button>
                                        @endif
                                    </form>
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
@endsection
