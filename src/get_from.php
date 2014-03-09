<?php

namespace florianec;

/**
 * @param object|array $object  Object (or array) to get value from.
 * @param array        $keys    List of property names (or array keys).
 * @param mixed        $default Default value
 *
 * @return mixed
 */
function get_from($object, array $keys, $default = null)
{
    if (!$keys) {
        return $object;
    }

    $current = $object;
    foreach ($keys as $key) {
        if (!is_array($object) && !property_exists($current, $key)) {
            return $default;
        } elseif (!array_key_exists($key, $current)) {
            return $default;
        }

        if (!is_array($current)) {
            $current = $current->$key;
        } else {
            $current = $current[$key];
        }
    }
    return $current;
}
