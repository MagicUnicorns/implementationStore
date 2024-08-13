<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

use Illuminate\Support\Facades\Log;

class OrganizationScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        Log::error("is there a user?");

        if (\Auth::hasUser()){
            Log::error("is there a user?".\Auth::hasUser());
            $builder->where('organization_id', '=', \Auth::user()->organization_id);
        }
    }
}
