<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class AdminWallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'commission_amount', 
        'promote_amount', 
        'freelancer_withdraw',
        'refund_to_client',
        'total_income',
        'balance',
    ];
}
