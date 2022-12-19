<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class ClientWallet extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'balance'];
}
