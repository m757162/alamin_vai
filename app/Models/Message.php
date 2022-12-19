<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'employee_id',
        'client_id',
        'message_parent_id',
        'type',
        'message',
        'is_seen',
        'is_employee_seen',
        'deleted_at',
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id', 'id');
    }

    public function employee()
    {
        return $this->belongsTo(Admin::class, 'employee_id', 'id');
    }
}
