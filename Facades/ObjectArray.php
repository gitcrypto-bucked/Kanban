<?php

namespace Facades;


class ObjectArray
{
    public static function validArray(array $array) 
    { 
            foreach ($array as $value) {
                if (is_array($value)) {
                    // If it's an array, recurse; if the sub-array is not all empty, return false
                    if (!self::validArray($value)) {
                        return false;
                    }
                } elseif ($value === 0 || $value === NULL) {
                    // If any value is NOT empty (and not strictly 0 or "0" which empty() considers empty), return false
                    // Note: empty() already handles 0, "0", null, false, etc.
                    return false;
                }
                return true;
            }
            
    }
}