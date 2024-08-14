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

                //TODO make this nice
                /**
                 * This assigns role "Super Admin" for each and every organization to user with id 1
                 * Make this great ;)
                 */
                if($organization->id > 1){
                    $session_team_id = getPermissionsTeamId();
                    // set actual new team_id to package instance
                    setPermissionsTeamId($organization);
                    // get the admin user and assign roles/permissions on new team model
                    User::find(1)->assignRole('Super Admin');
                    // restore session team_id to package instance using temporary value stored above
                    setPermissionsTeamId($session_team_id);
                }
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
