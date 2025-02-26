<?php 
namespace App\QueryFilters;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class OrderByEstadoFilter
{
    public function handle(Builder $query, Closure $next)
    {
        $query->orderByRaw("FIELD(estado, 'pendientes', 'completadas')");

        return $next($query);
    }
}