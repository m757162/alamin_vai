<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class UserTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'freelancer_id',
        'type',
        'amount',
        'description',
    ];
}
