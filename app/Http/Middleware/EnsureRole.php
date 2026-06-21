<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureRole
{
    public function handle(Request $request, Closure $next, string ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Please login to access this page.');
        }

        $allowedRoles = array_map([$this, 'normalizeRole'], $roles);
        $currentRole = $this->normalizeRole((string) optional(Auth::user())->role);

        // Backward compatibility: old customer accounts may have empty role values.
        if ($currentRole === '' && in_array('user', $allowedRoles, true)) {
            $currentRole = 'user';
        }

        if (empty($allowedRoles) || !in_array($currentRole, $allowedRoles, true)) {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }

    private function normalizeRole(string $role): string
    {
        $role = strtolower(trim($role));

        return match ($role) {
            'customer' => 'user',
            'superadmin', 'super-admin' => 'superadmin',
            'admin' => 'admin',
            default => $role,
        };
    }
}

