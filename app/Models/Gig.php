<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Gig extends Model
{
    use HasFactory, SoftDeletes, Cachable;

    protected $fillable = [
        'user_id',
        'category_id',
        'subcategory_id',
        'subsubcategory_id',
        'title',
        'description',
        'price',
        'estimate_day',
        'image',
        'status',
        'sales_count',
        'rating',
        'tag',
        'view',
        'deleted_at',
    ];

    public function fav_gig()
    {
       return $this->hasOne(Favourite::class);
    }
    public function count_gig()
    {
       return $this->hasMany(Favourite::class);
    }
    public function category()
    {
       return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
       return $this->belongsTo(Subcategory::class);
    }

    public function subsubcategory()
    {
       return $this->belongsTo(SubsubCategory::class, 'subsubcategory_id', 'id');
    }

    public function freelancer(){
      return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function rate()
    {
      return $this->hasOne(Rate::class);
    }

    public function scopeFiltering($query, array $filters)
    {
      if($filters['category_name'] ?? false){
         $query->whereHas('category', function($q){
               $q->where('name', 'like', '%'.request('category_name').'%');
         });
      }

      if($filters['subcategory_name'] ?? false){
         $query->whereHas('subcategory', function($q){
               $q->where('name', 'like', '%'.request('subcategory_name').'%');
         });
      }

      if($filters['subsubcategory_name'] ?? false){
         $query->whereHas('subsubcategory', function($q){
               $q->where('name', 'like', '%'.request('subsubcategory_name').'%');
         });
      }
      if($filters['search'] ?? false){
        
         $query->where('title', 'like', '%'.request('search').'%');
       
      }

    }

    public function scopeBudgetFilter($query, array $filters)
    {
      if($filters['min_budget'] ?? false){
         $query->whereBetween('price', [request('min_budget'), request('max_budget')]);
      
      }
    }

    //End
}
