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
}

// Exemplo de uso
$array = [
    'a' => [
        'b' => [
            0 => [
                'x' => 'chave encontrada!',
                'y' => 'outra chave'
            ],
            'd' => 'outra chave'
        ],
    ],
    'e' => [
        'f' => [
            0 => 'mais uma chave'
        ]
    ],
    'z' => [
        'g' => 'mais uma chave',
        'h' => [
            0 => [
                'x' => 'chave encontrada!',
                'y' => [0 => [
                    'x' => 'chave encontrada!',
                    'y' => 'outra chave'
                ]]
            ]
        ]
    ],
    'i' => [
        'f' => [
            'g' => 'mais uma chave'
        ]
    ],
    0 => 'chave numérica'
];

$chaveProcurada = 'h';
$resultados = Matrix::search($chaveProcurada, $array);

print_r($resultados);
