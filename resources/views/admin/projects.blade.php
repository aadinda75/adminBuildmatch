@extends('admin.layouts.main')

@section('title', 'Projects')
@section('header_title', 'Projects Overview')

@section('content')
    <div class="content-card">
        <!-- Filter Row -->
        <form action="{{ route('admin.projects.index') }}" method="GET" class="filter-row">
            <div class="form-search">
                <i class='bx bx-search'></i>
                <input type="text" name="search" placeholder="Search by title, style, or location..." value="{{ request('search') }}">
            </div>
            
            <select name="status" class="select-filter" onchange="this.form.submit()">
                <option value="">All Statuses</option>
                <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Open</option>
                <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
            </select>

            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-outline">Reset</a>
        </form>

        <!-- Projects Table -->
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Project & Location</th>
                        <th>Client</th>
                        <th>Specs & Sizing</th>
                        <th>Budget</th>
                        <th>Status</th>
                        <th>Progress</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($projects as $project)
                        <tr>
                            <td>
                                <div style="font-weight: 600; color: #3E2723;">{{ $project->title }}</div>
                                <div style="font-size: 0.78rem; color: #D97706; margin-top: 2px;">
                                    <i class='bx bx-map' style="vertical-align: middle; color: #B45309;"></i> {{ $project->location ?? 'No location set' }}
                                </div>
                            </td>
                            <td>
                                <div style="font-weight: 500;">{{ $project->client->name ?? 'Unknown Client' }}</div>
                                <div style="font-size: 0.75rem; color: var(--text-secondary);">{{ $project->client->phone ?? '' }}</div>
                            </td>
                            <td>
                                <div style="font-size: 0.85rem;">Land: {{ $project->land_size ?? '0' }} m² | Building: {{ $project->building_size ?? '0' }} m²</div>
                                <div style="font-size: 0.75rem; color: var(--text-secondary);">Style: {{ $project->style ?? 'Modern' }} | {{ $project->floors ?? 1 }} Floors</div>
                            </td>
                            <td>
                                <div style="font-weight: 600; color: #3E2723;">Rp {{ number_format($project->budget, 0, ',', '.') }}</div>
                            </td>
                            <td>
                                <span class="badge {{ $project->status }}">{{ $project->status }}</span>
                            </td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 8px; width: 120px;">
                                    @php
                                        $pct = $project->progress_percent ?? 0;
                                        if ($pct < 25) {
                                            $progColor = '#EBCAB6'; // Stage 1 (pudar)
                                        } elseif ($pct < 50) {
                                            $progColor = '#D49A7A'; // Stage 2
                                        } elseif ($pct < 75) {
                                            $progColor = '#B55B36'; // Stage 3
                                        } else {
                                            $progColor = '#8C2B0B'; // Stage 4 (tebal)
                                        }
                                    @endphp
                                    <div style="flex: 1; background: #F8F5F2; height: 8px; border-radius: 4px; overflow: hidden; border: 1px solid var(--border-color);">
                                        <div style="width: {{ $pct }}%; background: {{ $progColor }}; height: 100%; border-radius: 4px; transition: width 0.3s ease;"></div>
                                    </div>
                                    <span style="font-size: 0.8rem; font-weight: 600; min-width: 32px; text-align: right; color: {{ $progColor }};">{{ $pct }}%</span>
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('admin.projects.show', $project->id) }}" class="btn btn-outline btn-sm">
                                    <i class='bx bx-show'></i> Details
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; color: var(--text-muted); padding: 30px;">
                                No projects found matching filters.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-wrapper">
            {{ $projects->links() }}
        </div>
    </div>
@endsection
