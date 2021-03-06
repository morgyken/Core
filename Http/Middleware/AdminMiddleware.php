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
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Session\Store;
use Ignite\Core\Contracts\Authentication;

class AdminMiddleware {

    /**
     * @var Authentication
     */
    private $auth;

    /**
     * @var SessionManager
     */
    private $session;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var Redirector
     */
    private $redirect;

    /**
     * @var Application
     */
    private $application;

    /**
     * AdminMiddleware constructor.
     * @param Authentication $auth
     * @param Store $session
     * @param Request $request
     * @param Redirector $redirect
     * @param Application $application
     */
    public function __construct(Authentication $auth, Store $session, Request $request, Redirector $redirect, Application $application) {
        $this->auth = $auth;
        $this->session = $session;
        $this->request = $request;
        $this->redirect = $redirect;
        $this->application = $application;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        // Check if the user is logged in
        if (!$this->auth->check()) {
            // Store the current uri in the session
            $this->session->put('url.intended', $this->request->url());

            // Redirect to the login page
            return $this->redirect->route('public.login');
        }
        /*
          // Check if the user has access to the dashboard page
          if (!$this->auth->hasAccess('dashboard.index')) {
          // Show the insufficient permissions page
          return $this->application->abort(403);
          }
         */
        return $next($request);
    }

}
