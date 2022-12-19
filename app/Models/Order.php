<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'hire_id', 
        'commission_amount', 
        'freelancer_amount', 
        'total_amount', 
        'payment_status', 
        'delivery_status', 
        'payment_method', 
        'payment_info', 
        'description', 
        'file', 
        'is_accept', 
        'is_delivered', 
        'estimate_date', 
    ];

    public function hire()
    {
        return $this->belongsTo(Hire::class);
    }

    public function rate()
    {
        return $this->hasOne(Rate::class);
    }
}
