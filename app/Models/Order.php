<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'weight',
        'region',
        'delivery_hours',
    ];

    protected $casts = [
        'delivery_hours' => 'json',
        'assign_time' =>'datetime:Y-m-d\TH:i:s.v\Z',
        'complete_time' =>'datetime:Y-m-d\TH:i:s.v\Z',
    ];

    protected $guarded = ['id'];
}
