<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mine extends Model
{
    use HasFactory;

    protected $table = 'mines';

    protected $fillable = [
        'name',
        'address',
        'status',
    ];

    public function getStatusAttribute($value)
    {
        return $value === 'active' ? 'Aktif' : 'Tidak Aktif';
    }
}
