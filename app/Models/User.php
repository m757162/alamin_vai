<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_type',
        'name',
        'image',
        'email',
        'email_verified_at',
        'facebook_id',
        'google_id',
        'linkedin_id',
        'twitter_id',
        'password',
        'refer_code',
        'referral_id',
        'total_refers',
        'total_refer_claim',
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function skill()
    {
        return $this->hasOne(Skill::class);
    }

    public function social()
    {
        return $this->hasOne(Social::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }
}
