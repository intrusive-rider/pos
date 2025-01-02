<?php

namespace App\Http\Middleware;

use App\Models\Discount;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class ExpireDiscount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $now = Carbon::now();

        Discount::where('active', true)
            ->where('end_date', '<', $now)
            ->update(['active' => false]);

        return $next($request);
    }
}
