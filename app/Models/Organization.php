<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'organization_id'
    ];

    protected static function boot(){
        
        parent::boot();

        static::created(
            function ($organization) {
                $organization->setting()->create([
                    'organization_id' => $organization->id,
                ]);
        });
    }

    public function payments(){

        return $this->hasMany(Payment::class);

    }

    public function setting(){

        return $this->hasOne(Setting::class);

    }

    public function users(){

        return $this->hasMany(User::class);
        
    }
}
