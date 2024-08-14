<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;

use App\Models\Scopes\OrganizationScope;

#[ScopedBy([OrganizationScope::class])]
class Webhook extends Model
{
    use HasFactory;

    //enable mass assignment, this can be done as we check HMAC
    protected $guarded = [];
}
