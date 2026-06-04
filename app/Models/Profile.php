<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profiles';

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'phone',
        'role',
        'company_name',
        'npwp',
        'stra_number',
        'experience_years',
        'avatar_url',
        'is_verified',
        'nib',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class, 'client_id');
    }

    public function bids()
    {
        return $this->hasMany(Bid::class, 'vendor_id');
    }

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class, 'vendor_id');
    }

    public function certifications()
    {
        return $this->hasMany(Certification::class, 'vendor_id');
    }
}
