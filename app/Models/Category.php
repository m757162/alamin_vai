<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Category extends Model
{
    use HasFactory, Cachable;

    // protected $fillable = ['name', 'commission', 'image'];

    public function subcategory()
    {
        return $this->hasMany(Subcategory::class);
    }
}
