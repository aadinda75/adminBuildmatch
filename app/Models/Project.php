<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'client_id',
        'title',
        'description',
        'budget',
        'land_size',
        'building_size',
        'floors',
        'bedrooms',
        'bathrooms',
        'style',
        'location',
        'deadline',
        'image_urls',
        'status',
        'progress_percent',
        'house_style',
        'latitude',
        'longitude',
        'cover_image_url',
        'reference_pdf_url',
    ];

    protected $casts = [
        'budget' => 'decimal:2',
        'land_size' => 'decimal:2',
        'building_size' => 'decimal:2',
        'latitude' => 'decimal:6',
        'longitude' => 'decimal:6',
        'floors' => 'integer',
        'bedrooms' => 'integer',
        'bathrooms' => 'integer',
        'progress_percent' => 'integer',
        'image_urls' => 'array',
        'deadline' => 'date',
    ];

    public function client()
    {
        return $this->belongsTo(Profile::class, 'client_id');
    }

    public function bids()
    {
        return $this->hasMany(Bid::class, 'project_id');
    }

    public function contract()
    {
        return $this->hasOne(Contract::class, 'project_id');
    }

    public function paymentTerms()
    {
        return $this->hasMany(PaymentTerm::class, 'project_id');
    }
}
