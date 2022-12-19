<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;

    protected $fillable = [
        'freelancer_id',
        'buyer_request_id',
        'offer_letter',
        'budget',
        'estimate_date',
    ];
}
