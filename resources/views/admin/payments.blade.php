@extends('admin.layouts.main')

@section('title', 'Payment Milestones')
@section('header_title', 'Payment Milestones & Progress Verification')

@section('content')
    <div class="content-card">
        <!-- Filter Row -->
        <form action="{{ route('admin.payments.index') }}" method="GET" class="filter-row">
            <div class="form-search">
                <i class='bx bx-search'></i>
                <input type="text" name="search" placeholder="Search by project or contractor name..." value="{{ request('search') }}">
            </div>
            
            <select name="status" class="select-filter" onchange="this.form.submit()">
                <option value="">All Statuses</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="progress_approved" {{ request('status') == 'progress_approved' ? 'selected' : '' }}>Progress Approved</option>
                <option value="revision_requested" {{ request('status') == 'revision_requested' ? 'selected' : '' }}>Revision Requested</option>
                <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
            </select>

            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('admin.payments.index') }}" class="btn btn-outline">Reset</a>
        </form>

        <!-- Payments Table -->
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Project & Milestone</th>
                        <th>Contractor</th>
                        <th>Percentage & Amount</th>
                        <th>Status</th>
                        <th>Progress Submissions / Logs</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $payment)
                        <tr>
                            <td>
                                <div style="font-weight: 600; color: #0ea5e9;">{{ $payment->project->title ?? 'N/A' }}</div>
                                <div style="font-size: 0.85rem; font-weight: 500; margin-top: 4px; color: var(--text-primary);">
                                    Milestone: {{ $payment->name }}
                                </div>
                                <div style="font-size: 0.75rem; color: var(--text-muted);">Index: #{{ $payment->order_index }}</div>
                            </td>
                            <td>
                                <div style="font-weight: 500;">{{ $payment->vendor->name ?? 'Unknown Vendor' }}</div>
                                <div style="font-size: 0.75rem; color: var(--text-secondary);">{{ $payment->vendor->company_name ?? 'Individual' }}</div>
                            </td>
                            <td>
                                <div style="font-weight: 600; color: #10b981;">{{ $payment->percentage }}%</div>
                                <div style="font-size: 0.88rem; font-weight: 500;">Rp {{ number_format($payment->amount, 0, ',', '.') }}</div>
                            </td>
                            <td>
                                <span class="badge {{ $payment->status }}">{{ $payment->status }}</span>
                            </td>
                            <td>
                                @if($payment->progress_submitted_at)
                                    <div style="background: rgba(255, 255, 255, 0.02); border: 1px solid var(--border-color); padding: 12px; border-radius: 8px; font-size: 0.82rem; max-width: 320px;">
                                        <div style="font-weight: 600; margin-bottom: 4px; color: var(--text-primary);">Submitted Progress:</div>
                                        <p style="color: var(--text-secondary); line-height: 1.4; margin-bottom: 8px;">
                                            {{ $payment->progress_description ?? 'No progress text provided.' }}
                                        </p>
                                        
                                        <!-- Progress Images Array -->
                                        @if(!empty($payment->progress_images) && count($payment->progress_images) > 0)
                                            <div style="margin-bottom: 8px;">
                                                <div style="font-weight: 600; font-size: 0.75rem; margin-bottom: 4px; color: var(--text-muted);">Attachments:</div>
                                                <div class="images-flex" style="gap: 6px;">
                                                    @foreach($payment->progress_images as $img)
                                                        <a href="{{ $img }}" target="_blank">
                                                            <img src="{{ $img }}" class="progress-thumbnail" style="width: 48px; height: 48px;">
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif

                                        <!-- Progress PDF Link -->
                                        @if($payment->progress_pdf_url)
                                            <div style="margin-top: 4px;">
                                                <a href="{{ $payment->progress_pdf_url }}" target="_blank" style="color: #3b82f6; text-decoration: none; font-weight: 500; display: inline-flex; align-items: center; gap: 4px;">
                                                    <i class='bx bx-file'></i> View Progress PDF Document
                                                </a>
                                            </div>
                                        @endif
                                        
                                        <div style="font-size: 0.72rem; color: var(--text-muted); margin-top: 8px;">
                                            Submitted: {{ $payment->progress_submitted_at ? $payment->progress_submitted_at->format('d M Y H:i') : '' }}
                                        </div>

                                        <!-- Revision logs if any -->
                                        @if($payment->status === 'revision_requested')
                                            <div style="margin-top: 8px; border-top: 1px solid rgba(239, 68, 68, 0.2); padding-top: 8px; color: #ef4444;">
                                                <strong style="display:block;">Revision Requested:</strong>
                                                <span style="font-style:italic;">"{{ $payment->revision_notes }}"</span>
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <span style="color: var(--text-muted); font-size: 0.8rem; font-style: italic;">No progress submitted</span>
                                @endif
                            </td>
                            <td>
                                <div style="display: flex; flex-direction: column; gap: 8px; width: 140px;">
                                    @if($payment->progress_submitted_at && $payment->status === 'pending')
                                        <!-- Approve Progress Form -->
                                        <form action="{{ route('admin.payments.review', $payment->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="action" value="approve">
                                            <button type="submit" class="btn btn-success btn-sm" style="width: 100%;">
                                                <i class='bx bx-check-circle'></i> Approve Progress
                                            </button>
                                        </form>

                                        <!-- Toggle Reject Section -->
                                        <button type="button" class="btn btn-outline btn-sm" style="width: 100%;" 
                                                onclick="document.getElementById('revision-form-{{ $payment->id }}').style.display = 'block'; this.style.display = 'none';">
                                            <i class='bx bx-revision'></i> Ask Revision
                                        </button>

                                        <!-- Inline Revision Form -->
                                        <div id="revision-form-{{ $payment->id }}" style="display: none; background: rgba(255,255,255,0.02); border: 1px solid rgba(239,68,68,0.2); padding: 10px; border-radius: 8px; margin-top: 4px;">
                                            <form action="{{ route('admin.payments.review', $payment->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="action" value="reject">
                                                <textarea name="revision_notes" placeholder="Enter revision feedback..." required 
                                                          style="width: 100%; background: #111827; border: 1px solid var(--border-color); color: #fff; padding: 6px; border-radius: 6px; font-size: 0.8rem; height: 60px; resize: none; margin-bottom: 6px; outline: none;"></textarea>
                                                <div style="display: flex; gap: 4px;">
                                                    <button type="submit" class="btn btn-danger btn-sm" style="flex: 1; padding: 4px;">Send</button>
                                                    <button type="button" class="btn btn-outline btn-sm" style="padding: 4px 8px;" 
                                                            onclick="document.getElementById('revision-form-{{ $payment->id }}').style.display = 'none';">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    @endif

                                    @if($payment->status === 'progress_approved')
                                        <!-- Confirm Paid Form -->
                                        <form action="{{ route('admin.payments.confirm', $payment->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-sm" style="width: 100%;">
                                                <i class='bx bx-credit-card'></i> Confirm Paid
                                            </button>
                                        </form>
                                    @endif

                                    @if($payment->status === 'paid')
                                        <span class="badge verified" style="justify-content: center;">
                                            <i class='bx bx-badge-check' style="font-size: 1rem; margin-right: 4px;"></i> Transaction Done
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; color: var(--text-muted); padding: 30px;">
                                No payment milestone terms found matching filters.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-wrapper">
            {{ $payments->links() }}
        </div>
    </div>
@endsection
