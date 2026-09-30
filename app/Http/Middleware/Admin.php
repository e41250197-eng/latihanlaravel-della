<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role = 'admin'): Response
    {
        // Pengecekan parameter role via query string (?role=admin)
        if ($request->query('role') !== $role) {
            return response()->json([
                'status' => 'Ditolak',
                'pesan' => 'Akses ditolak! Anda bukan ' . $role . '.'
            ], 403);
        }

        return $next($request);
    }
}
