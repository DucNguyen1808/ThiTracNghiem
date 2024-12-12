<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SortMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $request->merge(['sort' => [
            'enabel' => false,
            'type' => 'default',
            'column' => ''
        ]]);
        if ($request->query->get('_sort')){
            $isValidtype = in_array($request->get('type'), ['asc', 'desc']);
            $request->merge(['sort' => [
                'enabel' => true,
                'type' => $isValidtype ? $request->query->get('type') : 'desc',
                'column' => $request->query->get('column')
            ]]);
        }

        return $next($request);
    }
}
