<?php

namespace App\QueryFilters;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class EstadoFilter
{
    public function handle(Builder $query, Closure $next)
    {
        if (!request()->filled('estado')) {
            return $next($query);
        }

        return $next($query->where('estado', request()->input('estado')));
    }
}
