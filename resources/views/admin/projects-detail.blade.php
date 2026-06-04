@extends('admin.layouts.main')

@section('title', 'Project Details')
@section('header_title', 'Project Details: ' . $project->title)

@section('content')
    <div style="margin-bottom: 20px;">
        <a href="{{ route('admin.projects.index') }}" class="btn btn-outline">
            <i class='bx bx-left-arrow-alt'></i> Back to Projects
        </a>
    </div>

    <!-- Project Overview Banner -->
    <div class="project-banner">
        <div>
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                <span class="badge {{ $project->status }}">{{ $project->status }}</span>
                <span style="font-size: 0.85rem; color: var(--text-secondary);">
                    Created: {{ $project->created_at ? $project->created_at->format('d M Y') : 'N/A' }}
                </span>
            </div>
            
            <h2 style="font-size: 1.8rem; font-weight: 700; margin-bottom: 10px; color: var(--text-primary);">
                {{ $project->title }}
            </h2>
            
            <p style="color: var(--text-secondary); line-height: 1.6; margin-bottom: 20px; font-size: 0.95rem;">
                {{ $project->description ?? 'No description provided.' }}
            </p>

            <div class="project-info-grid">
                <div class="project-info-item">
                    <label>Budget Limit</label>
                    <span>Rp {{ number_format($project->budget, 0, ',', '.') }}</span>
                </div>
                <div class="project-info-item">
                    <label>Deadline Target</label>
                    <span>{{ $project->deadline ? $project->deadline->format('d M Y') : 'No Target Set' }}</span>
                </div>
                <div class="project-info-item">
                    <label>Sizing</label>
                    <span>L: {{ $project->land_size ?? 0 }}m² | B: {{ $project->building_size ?? 0 }}m²</span>
                </div>
                <div class="project-info-item">
                    <label>House Layout</label>
                    <span>{{ $project->floors ?? 1 }} Flr | {{ $project->bedrooms ?? 0 }} Bed | {{ $project->bathrooms ?? 0 }} Bath</span>
                </div>
            </div>
        </div>

        <div>
            <div class="project-cover-container">
                @if($project->cover_image_url)
                    <img src="{{ $project->cover_image_url }}" alt="Project Cover">
                @else
                    <div style="background: rgba(255, 255, 255, 0.02); width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; flex-direction: column; color: var(--text-muted);">
                        <i class='bx bx-image-alt' style="font-size: 3rem; margin-bottom: 10px;"></i>
                        <span>No cover image uploaded</span>
                    </div>
                @endif
            </div>

            <!-- Client Summary Card -->
            <div class="content-card" style="margin-top: 20px; margin-bottom: 0; padding: 16px;">
                <h4 style="margin-bottom: 10px; font-size: 0.88rem; text-transform: uppercase; color: var(--text-secondary);">Client Profile</h4>
                <div style="display: flex; align-items: center; gap: 12px;">
                    <div class="user-avatar" style="width: 32px; height: 32px; font-size: 0.8rem;">
                        {{ strtoupper(substr($project->client->name ?? 'C', 0, 1)) }}
                    </div>
                    <div>
                        <div style="font-weight: 600; font-size: 0.9rem;">{{ $project->client->name ?? 'Unknown Client' }}</div>
                        <div style="font-size: 0.75rem; color: var(--text-secondary);">{{ $project->client->phone ?? '' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Gallery -->
    @if(!empty($project->image_urls) && count($project->image_urls) > 0)
        <div class="content-card">
            <h3 class="card-title" style="margin-bottom: 16px;">Reference Gallery</h3>
            <div class="images-flex">
                @foreach($project->image_urls as $img_url)
                    <a href="{{ $img_url }}" target="_blank">
                        <img src="{{ $img_url }}" alt="Reference Image" style="width: 140px; height: 100px; object-fit: cover; border-radius: 8px; border: 1px solid var(--border-color);">
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    <div class="dashboard-grid" style="margin-top: 30px;">
        <!-- Bids Section -->
        <div class="content-card">
            <div class="card-header">
                <h3 class="card-title">Bids Placed ({{ $project->bids->count() }})</h3>
            </div>
            <div class="table-responsive">
                @if($project->bids->isEmpty())
                    <p style="color: var(--text-muted); text-align: center; padding: 20px 0;">No bids submitted yet.</p>
                @else
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Vendor</th>
                                <th>Bid Price</th>
                                <th>Duration</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($project->bids as $bid)
                                <tr>
                                    <td>
                                        <div style="font-weight: 600;">{{ $bid->vendor->name ?? 'N/A' }}</div>
                                        <div style="font-size: 0.75rem; color: var(--text-secondary);">{{ $bid->vendor->company_name ?? 'Individual' }}</div>
                                    </td>
                                    <td><strong>Rp {{ number_format($bid->price, 0, ',', '.') }}</strong></td>
                                    <td>{{ $bid->estimation_months ?? 'N/A' }} Months</td>
                                    <td><span class="badge {{ $bid->status }}">{{ $bid->status }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

        <!-- Contract & Progress Details -->
        <div class="content-card">
            <div class="card-header">
                <h3 class="card-title">Contract Details</h3>
            </div>
            @if($project->contract)
                <div style="margin-bottom: 20px;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 12px; font-size: 0.9rem;">
                        <span style="color: var(--text-secondary);">Signed Value:</span>
                        <strong>Rp {{ number_format($project->contract->total_price, 0, ',', '.') }}</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 12px; font-size: 0.9rem;">
                        <span style="color: var(--text-secondary);">Duration:</span>
                        <span>{{ $project->contract->start_date ? $project->contract->start_date->format('d M Y') : 'N/A' }} to {{ $project->contract->end_date ? $project->contract->end_date->format('d M Y') : 'N/A' }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; font-size: 0.9rem;">
                        <span style="color: var(--text-secondary);">Status:</span>
                        <span class="badge {{ $project->contract->status }}">{{ $project->contract->status }}</span>
                    </div>
                </div>

                <div style="border-top: 1px solid var(--border-color); padding-top: 20px;">
                    <h4 style="font-size: 0.9rem; margin-bottom: 14px; text-transform: uppercase; color: var(--text-secondary);">Progress Updates Log</h4>
                    @if($project->contract->progressUpdates->isEmpty())
                        <p style="color: var(--text-muted); font-size: 0.85rem; font-style: italic;">No progress reports logged yet.</p>
                    @else
                        <ul style="list-style: none; display: flex; flex-direction: column; gap: 16px;">
                            @foreach($project->contract->progressUpdates as $update)
                                <li style="border-bottom: 1px solid rgba(255, 255, 255, 0.03); padding-bottom: 12px; position: relative;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                                        <span style="font-weight: 600; color: #10b981;">{{ $update->percentage }}% Completed</span>
                                        <span style="font-size: 0.75rem; color: var(--text-muted);">{{ $update->created_at ? $update->created_at->format('d M Y') : '' }}</span>
                                    </div>
                                    <p style="font-size: 0.85rem; color: var(--text-secondary); line-height: 1.4;">
                                        {{ $update->description }}
                                    </p>
                                    @if($update->photo_url)
                                        <a href="{{ $update->photo_url }}" target="_blank" style="margin-top: 8px; display: inline-block;">
                                            <img src="{{ $update->photo_url }}" alt="progress" style="width: 60px; height: 60px; object-fit: cover; border-radius: 6px; border: 1px solid var(--border-color);">
                                        </a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            @else
                <div style="text-align: center; color: var(--text-muted); padding: 30px 0;">
                    <i class='bx bx-file-blank' style="font-size: 2.5rem; margin-bottom: 8px; display: block;"></i>
                    <span>No active contract signed for this project yet.</span>
                </div>
            @endif
        </div>
    </div>
@endsection
