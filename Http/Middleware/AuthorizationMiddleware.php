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
use Illuminate\Http\Response;
use Ignite\Core\Contracts\Authentication;

class AuthorizationMiddleware {

    /**
     * @var Authentication
     */
    private $auth;

    /**
     * Authorization constructor.
     * @param Authentication $auth
     */
    public function __construct(Authentication $auth) {
        $this->auth = $auth;
    }

    /**
     * @param $request
     * @param \Closure $next
     * @param $permission
     * @return \Illuminate\Http\RedirectResponse|Response
     */
    public function handle($request, Closure $next, $permission) {
        if ($this->auth->hasAccess($permission) === false) {
            return $this->handleUnauthorizedRequest($request, $permission);
        }

        return $next($request);
    }

    /**
     * @param Request $request
     * @param $permission
     * @return \Illuminate\Http\RedirectResponse|Response
     */
    private function handleUnauthorizedRequest(Request $request, $permission) {
        if ($request->ajax()) {
            return response('Unauthorized.', Response::HTTP_UNAUTHORIZED);
        }
        if (!$request->user()) {
            return redirect()->guest('auth/login');
        }

        flash()->error(trans('core::core.permission denied', ['permission' => $permission]));

        return redirect()->back();
    }

}
