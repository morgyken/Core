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

namespace Ignite\Core\Library;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class CoreFunctions {

    /**
     * Perform master update to user profile
     * @param Request $request
     * @return mixed
     */
    public static function update_profile(Request $request) {
        $user = Auth::user();
        $profile = $user->profile;
        $profile->title = $request->title;
        $profile->first_name = $request->first_name;
        $profile->middle_name = $request->middle_name;
        $profile->last_name = $request->last_name;
        $profile->job_description = $request->job;
        $profile->phone = $request->mobile;
        $profile->mpdb = $request->mpdb;
        $profile->pin = $request->pin;

        //we can maybe change email
        $user->email = $request->email;
        $user->save();    // $user->login = $request->login;
        if ($request->hasFile('image')) {
            $image = Image::make($request->file('image')->getRealPath());
            $profile->photo = base64_encode($image->fit(160, 160)->encode('jpg')->stream());
        }
        return $profile->save();
    }

    /**
     * Check internet connectivity, if client is online
     * Reliable to use dynamic dns record
     * @return bool
     */
    public static function is_online() {
        return checkdnsrr('collabmed.net', 'ANY');
    }

    /**
     *
     * @param int|string $type
     * @param string $text
     * @param int|null $entity_id
     * @param string|null $icon
     * @param string|null $class
     * @param string|null $assets
     * @return mixed
     */
    public static function system_event_log($type, $text, $entity_id = null, $icon = null, $class = null, $assets = null) {
        //Type can be id or name
        if (!is_numeric($type))
            $type = \Dervis\Ignite\Core\Entities\LogTypes::firstOrCreate(['name' => $type])->first();
        return \Dervis\Ignite\Core\Entities\SystemLogs::create([
                    'type_id' => $type->id,
                    'text' => $text,
                    'user_id' => access()->id(),
                    'entity_id' => $entity_id,
                    'icon' => $icon,
                    'class' => $class,
                    'assets' => is_array($assets) && count($assets) ? json_encode($assets) : null,
        ]);
    }

}
