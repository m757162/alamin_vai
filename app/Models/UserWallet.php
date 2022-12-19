<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class UserWallet extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'pending_balance', 'balance'];
}
