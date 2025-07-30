
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckTenantStatus
{
    public function handle(Request $request, Closure $next)
    {
        $tenant = tenant();
        
        if (!$tenant) {
            abort(404, 'Tenant not found');
        }

        if ($tenant->status !== 'active') {
            return response()->view('tenant.suspended', compact('tenant'), 503);
        }

        return $next($request);
    }
}
