<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentTerm;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = PaymentTerm::with(['project', 'vendor']);

        // Filter by Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search by Project Title or Vendor Name
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->whereHas('project', function ($sub) use ($search) {
                    $sub->where('title', 'like', "%{$search}%");
                })->orWhereHas('vendor', function ($sub) use ($search) {
                    $sub->where('name', 'like', "%{$search}%");
                });
            });
        }

        $payments = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        return view('admin.payments', compact('payments'));
    }

    public function confirmPayment($id)
    {
        $payment = PaymentTerm::findOrFail($id);
        $payment->status = 'paid';
        $payment->confirmed_at = now();
        $payment->paid_at = $payment->paid_at ?? now();
        $payment->save();

        return back()->with('success', "Payment for milestone '{$payment->name}' has been confirmed successfully.");
    }

    public function reviewProgress(Request $request, $id)
    {
        $request->validate([
            'action' => 'required|in:approve,reject',
            'revision_notes' => 'required_if:action,reject|nullable|string',
        ]);

        $payment = PaymentTerm::findOrFail($id);

        if ($request->action === 'approve') {
            $payment->status = 'progress_approved';
            $payment->progress_reviewed_at = now();
            $payment->save();
            return back()->with('success', "Progress submission for milestone '{$payment->name}' has been approved.");
        } else {
            $payment->status = 'revision_requested';
            $payment->revision_notes = $request->revision_notes;
            $payment->revision_requested_at = now();
            $payment->progress_reviewed_at = now();
            $payment->save();
            return back()->with('warning', "Progress submission for milestone '{$payment->name}' has been sent back for revision.");
        }
    }
}
