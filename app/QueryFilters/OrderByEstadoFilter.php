<?php

namespace App\QueryFilters;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class OrderByEstadoFilter
{
    public function handle(Builder $query, Closure $next)
    {
        $query->orderByRaw("FIELD(estado, 'pendiente', 'completada')")
            ->orderBy('created_at', 'desc');

        return $next($query);
    }
}
