<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PickupRequest extends Model
{
    protected $casts = [
        'pickup_time' => 'datetime',
    ];

    public function scopePending($query)
    {
        return $query->where('status', \App\Constants\Status::PICKUP_PENDING);
    }

    public function statusBadge()
    {
        return match ($this->status) {
            \App\Constants\Status::PICKUP_PENDING    => '<span class="badge badge--warning">' . trans('Pending') . '</span>',
            \App\Constants\Status::PICKUP_PROCESSING => '<span class="badge badge--primary">' . trans('Processing') . '</span>',
            \App\Constants\Status::PICKUP_COMPLETED  => '<span class="badge badge--success">' . trans('Completed') . '</span>',
            \App\Constants\Status::PICKUP_CANCELLED  => '<span class="badge badge--danger">' . trans('Cancelled') . '</span>',
            default                                  => '<span class="badge badge--dark">' . trans('Unknown') . '</span>',
        };
    }
}
