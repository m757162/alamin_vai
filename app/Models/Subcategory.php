<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Subcategory extends Model
{
    use HasFactory, Cachable;

    protected $fillable = ['category_id','name', 'image'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function subsubcategory()
    {
        return $this->hasMany(SubsubCategory::class);
    }
}
