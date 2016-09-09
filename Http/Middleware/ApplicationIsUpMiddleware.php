<?php

/*
 * =============================================================================
 *
 * Collabmed Solutions Ltd
 * Project: Collabmed Health Platform
 * Author: Samuel Okoth <sodhiambo@collabmed.com>
 *
 * =============================================================================
 */

namespace Ignite\Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ApplicationIsUpMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  Request    $request
     * @param  Closure    $next
     * @return mixed
     * @throws \Exception
     */
    public function handle($request, Closure $next) {
        if (!file_exists(base_path('.env')) || !Schema::hasTable('users')) {
            throw new \Exception('Collabmed platform is not yet installed');
        }

        return $next($request);
    }

}
