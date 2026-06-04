<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $table = 'contracts';

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'project_id',
        'bid_id',
        'total_price',
        'start_date',
        'end_date',
        'status',
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function bid()
    {
        return $this->belongsTo(Bid::class, 'bid_id');
    }

    public function progressUpdates()
    {
        return $this->hasMany(ProgressUpdate::class, 'contract_id');
    }
}
