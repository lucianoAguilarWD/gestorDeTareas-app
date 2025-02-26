<?php 
namespace App\QueryFilters;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class FechaVencimientoFilter
{
    public function handle(Builder $query, Closure $next)
    {
        if (!request()->filled('start_date') && !request()->filled('end_date')) {
            return $next($query);
        }

        if (request()->filled('start_date')) {
            $query->where('fechaVencimiento', '>=', request()->input('start_date'));
        }

        if (request()->filled('end_date')) {
            $query->where('fechaVencimiento', '<=', request()->input('end_date'));
        }

        return $next($query);
    }
}