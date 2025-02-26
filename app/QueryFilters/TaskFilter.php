<?php

namespace App\QueryFilters;

use Closure;

class TaskFilter
{
    public function handle($request, Closure $next)
    {
        if (! request()->has('tareas_id')) {
            return $next($request);
        }

        return $next($request)->where('tareas_id', request()->input('tareas_id'));
    }
}
