<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyerRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'category_id',
        'subcategory_id',
        'subsubcategory_id',
        'description',
        'budget',
        'status',
        'estimate_date',

    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
