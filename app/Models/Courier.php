<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    use HasFactory;

    protected $fillable = [
        'courier_type',
        'regions',
        'working_hours',
    ];

    protected $casts = [
        'regions' => 'json',
        'working_hours' => 'json',
    ];

    protected $guarded = ['id'];
}
