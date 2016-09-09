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

use Illuminate\Support\Collection;

/**
 * Description of NavigationOrdener
 *
 * @author samuel
 */
class NavigationOrdener {

    public static function order(Collection $items) {
        $closure = function ($item1, $item2) {
            $item1 = self::getItem($item1);
            $item2 = self::getItem($item2);

            if ($item1['weight'] > $item2['weight']) {
                return 1;
            }
            if ($item1['weight'] < $item2['weight']) {
                return -1;
            }

            return 0;
        };
        return $items->sort($closure);
    }

    /**
     * @param $item
     * @return mixed
     */
    public static function getItem($item) {
        return isset($item['weight']) ? $item : $item->first();
    }

}
