<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $table = 'portfolios';

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'vendor_id',
        'title',
        'description',
        'location',
        'year',
        'budget',
        'image_url',
    ];

    public function vendor()
    {
        return $this->belongsTo(Profile::class, 'vendor_id');
    }
}
