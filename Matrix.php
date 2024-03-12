<?php

/**
 * Class Matrix
 * 
 * This class provides methods for performing operations on multidimensional arrays.
 */
class Matrix
{
    /**
     * Search for a specific key in a multidimensional array and return the corresponding found values.
     *
     * @param string|int $needle The key to be searched for.
     * @param array $haystack The multidimensional array where the search will be performed.
     * @return array An array containing values corresponding to the searched key.
     */
    public static function search($needle, array $haystack): array
    {
        $foundKeys = [];

        foreach ($haystack as $key => $value) {
            if ($key === $needle) {
                $foundKeys[] = is_array($value) ? $value : $value;
            } elseif (is_array($value)) {
                $foundKeys = array_merge($foundKeys, self::search($needle, $value));
            }
        }

        return $foundKeys;
    }
}
