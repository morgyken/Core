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
if (!function_exists('mconfig')) {

    /**
     * Get the module config values
     * @param $params
     * @return mixed
     */
    function mconfig($params) {
        return config('ignite.' . $params);
    }

}
if (!function_exists('smart_date')) {

    /**
     * Format the date
     * @param $the_date
     * @return mixed
     */
    function smart_date($the_date) {
        return (new \Date($the_date))->format('jS M y');
    }

}
if (!function_exists('smart_time')) {

    /**
     * Format an instance to the time
     * @param $the_time
     * @return mixed
     */
    function smart_time($the_time) {
        return (new \Date($the_time))->format('g:i a');
    }

}
if (!function_exists('smart_date_time')) {

    /**
     * Nice way to show date and time
     * @param $timestamp
     * @return string
     */
    function smart_date_time($timestamp) {
        return smart_date($timestamp) . ' ' . smart_time($timestamp);
    }

}

if (!function_exists('upload_image')) {

    /**
     * Upload image and get image filename.
     *
     * @param UploadedFile $file
     * @param string       $path
     * @param string       $event
     *
     * @return string
     */
    function upload_image($file, $path, $event = 'image.uploaded') {
        if (!is_null($file)) {
            $filename = sha1(time() . $file->getClientOriginalName()) . '.' . strtolower($file->getClientOriginalExtension());

            $file->move(public_path($path), $filename);

            event($event, [$path . $filename]);

            return $filename;
        }

        return;
    }

}

if (!function_exists('set_active')) {

    /**
     * Set active to specified selector.
     *
     * @param array|string $paths
     * @param string       $class
     *
     * @return string
     */
    function set_active($paths, $class = 'active') {
        foreach ((array) $paths as $path) {
            if (Request::is($path)) {
                return $class;
            }
        }
    }

}

if (!function_exists('flash')) {

    /**
     * Flash message.
     *
     * @require "laracasts/flash:~1.3"
     *
     * @param string|null $message
     *
     * @return string|object
     */
    function flash($message = null) {
        $flash = app('flash');
        if (is_null($message)) {
            return $flash;
        }

        return $flash->success($message);
    }

}

if (!function_exists('error_for')) {

    /**
     * Show validation for the specified field.
     *
     * @param string $field
     * @param object $errors
     *
     * @return string
     */
    function error_for($field, $errors, $template = '<div class="text-danger">:message</div>') {
        return $errors->first($field, $template);
    }

}

if (!function_exists('gravatar')) {

    /**
     * Gravatar URL from Email address.
     *
     * @param string $email   Email address
     * @param string $size    Size in pixels
     * @param string $default Default image [ 404 | mm | identicon | monsterid | wavatar ]
     * @param string $rating  Max rating [ g | pg | r | x ]
     *
     * @return string
     */
    function gravatar($email, $size = 60, $default = 'mm', $rating = 'g') {
        return 'http://www.gravatar.com/avatar/' . md5(strtolower(trim($email))) . "?s={$size}&d={$default}&r={$rating}";
    }

}

if (!function_exists('markdown')) {

    /**
     * Markdown.
     *
     * @param string $text
     *
     * @return string
     */
    function markdown($text) {
        return (new ParsedownExtra())->text($text);
    }

}

if (!function_exists('route_names')) {

    /**
     * @param  string $name
     * @return array
     */
    function route_names($name) {
        $methods = ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'];

        $names = [];

        foreach ($methods as $method) {
            $names[$method] = $name . ".{$method}";
        }

        return $names;
    }

}

if (!function_exists('_resource')) {

    /**
     * @param  string $name
     * @param  string $controller
     * @param  array $options
     * @return void
     */
    function _resource($name, $controller, array $options = []) {
        $default['names'] = route_names($name);

        Route::resource($name, $controller, array_merge($default, $options));
    }

}

if (!function_exists('on_route')) {

    /**
     * @param $route
     * @return bool
     */
    function on_route($route) {
        return Route::current() ? Route::is($route) : false;
    }

}
if (!function_exists('is_module_enabled')) {

    /**
     * @param $module
     * @return bool
     */
    function is_module_enabled($module) {
        return array_key_exists($module, app('modules')->enabled());
    }

}
if (!function_exists('m_asset')) {

    /**
     * Generate a nice asset path for modules
     * @param $path
     * @return string
     */
    function m_asset($path) {
        $vars = explode(':', $path);
        if (\Module::has($vars[0])) {
            return asset('modules/' . implode('/', $vars));
        }
        //what if this does not exist?
        return asset('modules/' . implode('/', $vars));
    }

}