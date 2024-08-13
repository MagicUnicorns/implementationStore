<?php

namespace App\Models;

use App\Models\Scopes\OrganizationScope;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Model;

use Spatie\Permission\Models\Role as SpatieRole;

#[ScopedBy([OrganizationScope::class])]
class Role extends SpatieRole
{
    use HasFactory;
}
