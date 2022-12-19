<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class BusinessSetting extends Model
{
    use HasFactory, Cachable;

    protected $fillable = ['key', 'value'];
}
