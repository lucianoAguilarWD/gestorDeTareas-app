<?php

namespace App\QueryFilters;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class Buscador
{
    public function handle(Builder $query, Closure $next)
    {
        if (!request()->filled('query')) {
            return $next($query);
        }

        return $next($query->where(function ($q) {
            $q->where('titulo', 'like', '%' . request()->input('query') . '%');
        }));
    }
}
