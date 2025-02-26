<?php

namespace App\QueryFilters;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class UsuarioFilter
{
    public function handle(Builder $query, Closure $next)
    {
        if (!request()->filled('mis_tareas')) {
            return $next($query);
        }

        return $next($query->where('usuario_id', Auth::id()));
    }
}
