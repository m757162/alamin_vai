<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class AdminTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'freelancer_id',
        'client_id',
        'type',
        'amount',
        'description',
    ];

    public function freelancer()
    {
        return $this->belongsTo(User::class, 'freelancer_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id', 'id');
    }

    //End
}
