# Examples of Using the MatrixTools Class

The `MatrixTools` class provides various functions for performing operations on multidimensional arrays. Below are examples of how to use each of them.

## 1. `searchByKey`

```php
$matrix = [
    'name' => 'John',
    'age' => 30,
    'address' => [
        'city' => 'New York',
        'zip' => '10001',
    ],
];
$result = MatrixTools::searchByKey('city', $matrix);
print_r($result);

```

## 2. `searchByValue`

```php
$matrix = [
    'apple',
    'banana',
    ['orange', 'kiwi'],
    'apple',
    ['banana', 'grape'],
];

$result = MatrixTools::searchByValue('banana', $matrix);
print_r($result);

```

## 3. `countOccurrences`

```php
$matrix = [
    'apple',
    'banana',
    ['orange', 'kiwi'],
    'apple',
    ['banana', 'grape'],
];

$result = MatrixTools::countOccurrences($matrix);
print_r($result);

```

## 4. `replaceValue`

```php
$matrix = [
    'apple',
    'banana',
    ['orange', 'kiwi'],
    'apple',
    ['banana', 'grape'],
];

$result = MatrixTools::replaceValue('banana', 'pear', $matrix);
print_r($result);

```

## 5. `replaceKey`

```php
$matrix = [
    'name' => 'John',
    'age' => 30,
    'address' => [
        'city' => 'New York',
        'zip' => '10001',
    ],
];

$result = MatrixTools::replaceKey('city', 'town', $matrix);
print_r($result);

```

## 6. `sumValues`

```php
$matrix = [
    1,
    [2, 3],
    [4, [5, 6]],
];

$result = MatrixTools::sumValues($matrix);
echo $result;

```

## 7. `removeElementByValue`

```php
$matrix = [
    'apple',
    'banana',
    ['orange', 'kiwi'],
    'apple',
    ['banana', 'grape'],
];

$result = MatrixTools::removeElementByValue('banana', $matrix);
print_r($result);

```

## 8. `removeElementByKey`

```php
$matrix = [
    'name' => 'John',
    'age' => 30,
    'address' => [
        'city' => 'New York',
        'zip' => '10001',
    ],
];

$result = MatrixTools::removeElementByKey('city', $matrix);
print_r($result);

```

## 9. `sortByValue`

```php
$matrix = [
    'apple',
    'banana',
    'grape',
    'orange',
];

$result = MatrixTools::sortByValue($matrix, 'desc');
print_r($result);

```

## 10. `sortByKey`

```php
$matrix = [
    'name' => 'John',
    'age' => 30,
    'address' => [
        'city' => 'New York',
        'zip' => '10001',
    ],
];

$result = MatrixTools::sortByKey($matrix, 'desc');
print_r($result);

```

## 11. `mergeMatrices`

```php
$matrix1 = [
    'name' => 'John',
    'age' => 30,
    'address' => [
        'city' => 'New York',
        'zip' => '10001',
    ],
];

$matrix2 = [
    'address' => [
        'state' => 'NY',
    ],
    'phone' => '123-456-7890',
];

$result = MatrixTools::mergeMatrices($matrix1, $matrix2);
print_r($result);

```

## 12. `isMultidimensional`

```php
$matrix = ['apple', 'banana', 'orange'];

$result = MatrixTools::isMultidimensional($matrix);
var_dump($result);
```
