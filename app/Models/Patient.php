<?php

namespace App\Models;

use App\Models\Scopes\OrganizationScope;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;

#[ScopedBy([OrganizationScope::class])]
class Patient extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'organization_id',
        'customer_id',
        'gender',
        'date_of_birth',
        'date_deceased',
        'medical_history_summary',
        'notes',
    ];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function organization(){
        return $this->belongsTo(Organization::class);
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_of_birth' => 'datetime',
        'date_deceased' => 'datetime',
    ];
}
