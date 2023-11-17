<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'mine_id',
        'driver_id',
        'vehicle_id',
        'start_date',
        'return_date',
        'approver_1',
        'approver_2',
        'approved_1_by',
        'approved_2_by',
        'approved_1_at',
        'approved_2_at',
        'created_by',
        'rejected_by',
        'rejected_at',
        'status',
    ];

    public function mine()
    {
        return $this->belongsTo(Mine::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function approver1()
    {
        return $this->belongsTo(User::class, 'approver_1');
    }

    public function approver2()
    {
        return $this->belongsTo(User::class, 'approver_2');
    }

    public function approved1By()
    {
        return $this->belongsTo(User::class, 'approved_1_by');
    }

    public function approved2By()
    {
        return $this->belongsTo(User::class, 'approved_2_by');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function rejectedBy()
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }

    public function getIsApproverAttribute()
    {
        $user_id = auth()->user()->id;

        if ($this->approver_1 == $user_id || $this->approver_2 == $user_id) {
            return true;
        }
    }
}
