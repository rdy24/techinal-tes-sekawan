<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $table = 'vehicles';

    protected $fillable = [
        'name',
        'company_id',
        'license_plate',
        'ownership',
        'load_type',
        'fuel_capacity',
        'status',
        'service_schedule',
    ];

    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function getOwnershipAttribute($value): string
    {
        return $value === 'rent' ? 'Sewa Perusahaan Persewaan' : 'Milik Perusahaan';
    }

    public function getLoadTypeAttribute($value): string
    {
        return $value === 'person' ? 'Orang' : 'Barang';
    }

    
}
