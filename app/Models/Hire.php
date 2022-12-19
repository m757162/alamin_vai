<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hire extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'client_id', 
        'gig_id', 
        'rate', 
        'hire_type', 
    ];

    public function freelancer()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id', 'id');
    }

    public function gig()
    {
        return $this->belongsTo(Gig::class);
    }

    public function order()
    {
        return $this->hasOne(Order::class);
    }

    
}
