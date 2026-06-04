<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTerm extends Model
{
    use HasFactory;

    protected $table = 'payment_terms';

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'project_id',
        'bid_id',
        'vendor_id',
        'name',
        'percentage',
        'amount',
        'status',
        'order_index',
        'notes',
        'payment_method',
        'virtual_account_number',
        'paid_at',
        'confirmed_at',
        'progress_description',
        'progress_images',
        'progress_pdf_url',
        'progress_submitted_at',
        'progress_reviewed_at',
        'revision_notes',
        'revision_requested_at',
    ];

    protected $casts = [
        'percentage' => 'decimal:2',
        'amount' => 'decimal:2',
        'order_index' => 'integer',
        'progress_images' => 'array',
        'paid_at' => 'datetime',
        'confirmed_at' => 'datetime',
        'progress_submitted_at' => 'datetime',
        'progress_reviewed_at' => 'datetime',
        'revision_requested_at' => 'datetime',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function bid()
    {
        return $this->belongsTo(Bid::class, 'bid_id');
    }

    public function vendor()
    {
        // Links to profile of the vendor
        return $this->belongsTo(Profile::class, 'vendor_id');
    }
}
