<?php
// filepath: /opt/job-linker/src/app/Http/Middleware/HandleErrors.php
namespace App\Http\Middleware;

use Closure;
use Exception;

class HandleErrors
{
    public function handle($request, Closure $next)
    {
        try {
            return $next($request);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}