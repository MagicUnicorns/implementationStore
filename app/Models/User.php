<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable //implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'organization_id',
        'password',
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

    protected static function boot(){
        
        parent::boot();

        static::created(
            function ($user) {
                $user->setting()->create([
                    'company_name' => $user->username,
                ]);
        });
    }

    public function setting(){

        return $this->hasOne(Setting::class);

    }

    public function merchantProfiles(){

        return $this->hasMany(MerchantProfile::class);

    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function organization(){
        return $this->belongsTo(Organization::class);
    }
}
