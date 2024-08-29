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

    public function organization(){
        return $this->belongsTo(Organization::class);
    }
}
