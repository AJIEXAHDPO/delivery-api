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
    ];

    protected $guarded = ['id'];
}
