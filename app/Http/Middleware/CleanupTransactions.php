<?php

namespace App\Http\Middleware;

use App\Models\Transaction;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CleanupTransactions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Transaction::where('buyer', 'Buyer')->delete();
        return $next($request);
    }
}
