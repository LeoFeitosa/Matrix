<?php

/**
 * Class Matrix
 * 
 * This class provides methods for performing operations on multidimensional arrays, such as searching for a specific key.
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
    public static function searchByKey($needle, array $haystack): array
    {
        $foundKeys = [];

        foreach ($haystack as $key => $value) {
            if ($key === $needle) {
                $foundKeys[] = is_array($value) ? $value : $value;
            } elseif (is_array($value)) {
                $foundKeys = array_merge($foundKeys, self::searchByKey($needle, $value));
            }
        }

        return $foundKeys;
    }

    /**
     * Search for a specific value in a multidimensional array and return the corresponding keys.
     *
     * @param mixed $needle The value to be searched for.
     * @param array $haystack The multidimensional array where the search will be performed.
     * @return array An array containing keys corresponding to the searched value.
     */
    public static function searchByValue($needle, array $haystack): array
    {
        $foundItems = [];

        $search = function ($value, $currentKeys = []) use ($needle, &$foundItems, &$search) {
            if ($value === $needle) {
                $nestedArray = &$foundItems;

                foreach ($currentKeys as $nestedKey) {
                    $nestedArray = &$nestedArray[$nestedKey];
                }

                $nestedArray = $needle;
            } elseif (is_array($value)) {
                foreach ($value as $nestedKey => $nestedValue) {
                    $search($nestedValue, array_merge($currentKeys, [$nestedKey]));
                }
            }
        };

        foreach ($haystack as $key => $value) {
            $search($value, [$key]);
        }

        return $foundItems;
    }

    /**
     * Count the occurrences of each value in a multidimensional array recursively.
     *
     * This function traverses a multidimensional array and counts the occurrences of each distinct value.
     * The result is an associative array where keys are unique values found in the array,
     * and values are the corresponding occurrence counts.
     *
     * @param array $haystack The multidimensional array where the count will be performed.
     * @return array An associative array containing values as keys and their corresponding occurrence counts.
     */
    public static function countOccurrences(array $haystack): array
    {
        $occurrences = [];

        foreach ($haystack as $key => $value) {
            if (is_array($value)) {
                $nestedOccurrences = self::countOccurrences($value);
                foreach ($nestedOccurrences as $nestedKey => $count) {
                    $occurrences[$nestedKey] = isset($occurrences[$nestedKey]) ? $occurrences[$nestedKey] + $count : $count;
                }
            } else {
                $occurrences[$value] = isset($occurrences[$value]) ? $occurrences[$value] + 1 : 1;
            }
        }

        return $occurrences;
    }

    /**
     * Replace a specific value with a new value in a multidimensional array.
     *
     * @param mixed $oldValue The value to be replaced.
     * @param mixed $newValue The new value to replace the old value.
     * @param array $haystack The multidimensional array where the replacement will be performed.
     * @return array The array after the replacement.
     */
    public static function replaceValue($oldValue, $newValue, array $haystack): array
    {
        $callback = function ($value) use ($oldValue, $newValue) {
            return ($value === $oldValue) ? $newValue : $value;
        };

        return array_map(function ($item) use ($callback, $oldValue, $newValue) {
            return is_array($item) ? self::replaceValue($oldValue, $newValue, $item) : $callback($item);
        }, $haystack);
    }

    /**
     * Replace a specific key with a new key in a multidimensional array.
     *
     * @param mixed $oldKey The key to be replaced.
     * @param mixed $newKey The new key to replace the old key.
     * @param array $haystack The multidimensional array where the replacement will be performed.
     * @return array The array after the replacement.
     */
    public static function replaceKey($oldKey, $newKey, array $haystack): array
    {
        $newArray = [];

        foreach ($haystack as $key => $value) {
            $currentKey = ($key === $oldKey) ? $newKey : $key;
            $newArray[$currentKey] = is_array($value) ? self::replaceKey($oldKey, $newKey, $value) : $value;
        }

        return $newArray;
    }

    /**
     * Calculate the sum of all numeric elements in a multidimensional array.
     *
     * @param array $haystack The multidimensional array for which to calculate the sum.
     * @return float The sum of all numeric elements in the array.
     */
    public static function sumValues(array $haystack): float
    {
        $sum = 0;

        foreach ($haystack as $value) {
            if (is_array($value)) {
                $sum += self::sumValues($value);
            } elseif (is_numeric($value)) {
                $sum += $value;
            }
        }

        return $sum;
    }

    /**
     * Remove an element with a specific value from a multidimensional array.
     *
     * @param mixed $valueToRemove The value to be removed.
     * @param array $haystack The multidimensional array where the removal will be performed.
     * @return array The array after the removal.
     */
    public static function removeElementByValue($valueToRemove, array $haystack): array
    {
        foreach ($haystack as $key => $value) {
            if (is_array($value)) {
                $haystack[$key] = self::removeElementByValue($valueToRemove, $value);
            } elseif ($value === $valueToRemove) {
                unset($haystack[$key]);
            }
        }

        return $haystack;
    }

    /**
     * Remove an element with a specific key from a multidimensional array.
     *
     * @param mixed $keyToRemove The key to be removed.
     * @param array $haystack The multidimensional array where the removal will be performed.
     * @return array The array after the removal.
     */
    public static function removeElementByKey($keyToRemove, array $haystack): array
    {
        foreach ($haystack as $key => $value) {
            if ($key === $keyToRemove) {
                unset($haystack[$key]);
            } elseif (is_array($value)) {
                $haystack[$key] = self::removeElementByKey($keyToRemove, $value);
            }
        }

        return $haystack;
    }
}
