<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    protected $fillable = [
        'freelancer_id', 
        'client_id', 
        'order_id', 
        'client_rate',
        'freelancer_rate',
        'freelancer_feedback',
        'client_feedback'
    ];
}
