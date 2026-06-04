<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;

    protected $table = 'bids';

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'project_id',
        'vendor_id',
        'price',
        'message',
        'status',
        'rab_url',
        'estimation_months',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'estimation_months' => 'integer',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function vendor()
    {
        return $this->belongsTo(Profile::class, 'vendor_id');
    }

    public function contract()
    {
        return $this->hasOne(Contract::class, 'bid_id');
    }
}
