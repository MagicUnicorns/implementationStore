<?php

namespace App\Models;

use App\Models\Scopes\OrganizationScope;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Model;

#[ScopedBy([OrganizationScope::class])]
class Customer extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title_pre',
        'first_name',
        'title_mid',
        'last_name',
        'title_post',
        'email',
        'phone',
        'secondary_phone',
        'address_line1',
        'address_line2',
        'city',
        'state',
        'postal_code',
        'country',
        'preferred_contact_method',
        'notes',
        'emergency_contact_name',
        'emergency_contact_phone',
        'organization_id',
    ];

    public function organization(){
        return $this->belongsTo(Organization::class);
    }
}
