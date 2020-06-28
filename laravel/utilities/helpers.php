<?php

use Illuminate\Support\Arr;

/**
 * Array keyBy
 *
 * @param   array  $array
 * @param   string $keyPath
 * @return  array
 */
if (!function_exists('array_key_by')) {
    function array_key_by(array $array = [], $keyPath = '_id')
    {
        return array_combine(array_map('strval', Arr::pluck($array, $keyPath)), $array);
    }
}
