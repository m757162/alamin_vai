<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class ClientTransaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'type',
        'amount',
        'description',
    ];
}
