<?php

namespace App\QueryFilters;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class PrioridadFilter
{
    public function handle(Builder $query, Closure $next)
    {
        if (!request()->filled('prioridad')) {
            return $next($query);
        }

        return $next($query->where('prioridad', request()->input('prioridad')));
    }
}
