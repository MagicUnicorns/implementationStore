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

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function organization(){
        return $this->belongsTo(Organization::class);
    }
}
