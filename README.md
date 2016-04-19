# Basic collection library

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist yii2mod/collection "*"
```

or add

```
"yii2mod/collection": "*"
```

to the require section of your `composer.json` file.

Creating Collections
-------------------
```php
$collection = new Collection([1, 2, 3]);
```

Available Methods
-------------------
1. **[all()](#all)**
2. **[avg()](#avg)**
3. **[chunk()](#chunk)**
4. **[collapse()](#collapse)**
5. **[combine()](#combine)**
6. **[contains()](#contains)**
7. **[count()](#count)**
8. **[diff()](#diff)**
9. **[each()](#each)**
10. **[every()](#every)**
11. **[except()](#except)**
12. **[filter()](#filter)**
13. **[first()](#first)**
14. **[last()](#last)**
15. **[flatMap()](#flatmap)**
16. **[flatten()](#flatten)**
17. **[flip()](#flip)**
18. **[forget()](#forget)**
19. **[forPage()](#forpage)**
20. **[get()](#get)**
21. **[groupBy()](#groupby)**
22. **[has()](#has)**
23. **[implode()](#implode)**
24. **[intersect()](#intersect)**
25. **[isEmpty()](#isempty)**
26. **[keyby()](#keyby)**
27. **[keys()](#keys)**
28. **[map()](#map)**


Method Listing
-------------------
#####```all()```

Get all of the items in the collection:
```php
$collection = new Collection([1, 2, 3]);
$collection->all();
// [1, 2, 3]
```
------

#####```avg()```

Get the average value of a given key:
```php
$collection = new Collection([1, 2, 3, 4,5]);
$collection->avg();
// 3
```
------

#####```chunk()```

Chunk the underlying collection array:
```php
$collection = new Collection([1, 2, 3, 4, 5, 6, 7]);

$chunks = $collection->chunk(4);

$chunks->toArray();

// [[1, 2, 3, 4], [5, 6, 7]]
```
------

#####```collapse()```

Collapse the collection of items into a single array:
```php
$collection = new Collection([[1, 2, 3], [4, 5, 6], [7, 8, 9]]);

$collapsed = $collection->collapse();

$collapsed->all();

// [1, 2, 3, 4, 5, 6, 7, 8, 9]
```
------

#####```combine()```

Create a collection by using this collection for keys and another for its values:
```php
$collection = new Collection(['name', 'age']);

$combined = $collection->combine(['George', 29]);

$combined->all();

// ['name' => 'George', 'age' => 29]
```
------

#####```contains()```

Determine if an item exists in the collection:
```php
$collection = new Collection(['city' => 'Alabama', 'country' => 'USA']);

$collection->contains('Alabama');

// true

$collection->contains('New York');

// false
```

You may also pass a key / value pair to the contains method, which will determine if the given pair exists in the collection:

```php
$collection = new Collection([
            ['city' => 'Alabama'],
            ['city' => 'New York']
        ]);

$collection->contains('city', 'New York');

// true
```
------

#####```count()```

Return count the number of items in the collection:
```php
$collection = new Collection([1, 2, 3, 4, 5]);

$collection->count();

// 5
```
------

#####```diff()```

Get the items in the collection that are not present in the given items:
```php
$collection = new Collection([1, 2, 3, 4, 5]);

$diff = $collection->diff([2, 4, 6, 8]);

$diff->all();

// [1, 3, 5]
```
------

#####```each()```

Execute a callback over each item:
```php
$collection = $collection->each(function ($item, $key) {
    if (/* some condition */) {
        return false;
    }
});
```
------

#####```every()```

Create a new collection consisting of every n-th element:
```php
$collection = new Collection(['a', 'b', 'c', 'd', 'e', 'f']);

$collection->every(4);

// ['a', 'e']
```
------

#####```except()```

Get all items except for those with the specified keys:
```php
$collection = new Collection(['id' => 1, 'name' => 'Desk', 'price' => 100, 'discount' => false]);

$filtered = $collection->except(['price', 'discount']);

$filtered->all();

// ['id' => 1, 'name' => 'Desk']
```
------

#####```filter()```

Run a filter over each of the items:
```php
$collection = new Collection([1, 2, 3, 4]);

$filtered = $collection->filter(function ($value, $key) {
    return $value > 2;
});

$filtered->all();

// [3, 4]
```
------

#####```first()```

Get the first item from the collection:
```php
$collection = new Collection([1, 2, 3, 4, 5]);

$collection->first();

// 1
```
------

#####```last()```

Get the last item from the collection:
```php
$collection = new Collection([1, 2, 3, 4, 5]);

$collection->last();

// 5
```
------

#####```flatMap()```

Map a collection and flatten the result by a single level:
```php
$collection = new Collection(
    ['name' => 'Sally'],
    ['school' => 'Arkansas'],
    ['age' => 28]
]);

$flattened = $collection->flatMap(function ($values) {
    return strtoupper($values);
});

$flattened->all();

// ['name' => 'SALLY', 'school' => 'ARKANSAS', 'age' => 28];
```
------

#####```flatten()```

Map a collection and flatten the result by a single level:
```php
$collection = new Collection(['language' => 'java', 'languages' => ['php', 'javascript']]);

$collection->flatten();

// ['java', 'php', 'javascript']
```
------

#####```flip()```

Flip the items in the collection:
```php
$collection = new Collection(['firstName' => 'Igor', 'lastName' => 'Chepurnoy']);

$collection->flip();

// ['igor' => 'firstName', 'chepurnoy' => 'lastName']
```
------

#####```forget()```

Remove an item from the collection by key:
```php
$collection = new Collection(['firstName' => 'Igor', 'lastName' => 'Chepurnoy']);

$collection->forget('firstName');

$collection->all();

// ['lastName' => 'Chepurnoy']
```
------

#####```forPage()```

"Paginate" the collection by slicing it into a smaller collection:
```php
$collection = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9]);

$chunk = $collection->forPage(2, 3);

$chunk->all();

// [4, 5, 6]
```
---------

#####```get()```

Get an item from the collection by key:
```php
$collection = new Collection([
'User' => [
    'identity' => [
        'id' => 1
    ]
]
]);

$collection->get('User.identity.id');

// 1
```
---------

#####```groupBy()```

Group an associative array by a field or using a callback:
```php
$collection = new Collection([
     ['id' => 'id_2', 'name' => 'Bob'],
     ['id' => 'id_2', 'name' => 'John'],
     ['id' => 'id_3', 'name' => 'Frank'],
]);

$grouped = $collection->groupBy('id');

$grouped->toArray();
/*
[
    'id_2' => [
        ['id' => 'id_2', 'name' => 'Bob'],
        ['id' => 'id_2', 'name' => 'John'],
    ],
    'id_3' => [
        ['id' => 'id_3', 'name' => 'Frank'],
    ],
]
*/
```
---------

#####```has()```

Determine if an item exists in the collection by key:
```php
$collection = new Collection(['id' => 1, 'name' => 'Igor']);

$collection->has('id');

// true
```
---------

#####```implode()```

Concatenate values of a given key as a string:
```php
$collection = new Collection([
    ['account_id' => 1, 'name' => 'Ben'],
    ['account_id' => 2, 'name' => 'Bob'],
]);

$collection->implode('name', ', ');

// Ben, Bob
```
---------

#####```intersect()```

Intersect the collection with the given items:
```php
$collection = new Collection(['php', 'python', 'ruby']);

$intersect = $collection->intersect(['python', 'ruby', 'javascript']);

$intersect->all();

// [1 => 'python', 2 => 'ruby']
```
---------

#####```isEmpty()```

Determine if the collection is empty or not:
```php
$collection = (new Collection([]))->isEmpty();

// true
```
---------

#####```keyBy()```

Key an associative array by a field or using a callback:
```php
$collection = new Collection([
    ['product_id' => '100', 'name' => 'desk'],
    ['product_id' => '200', 'name' => 'chair'],
]);

$keyed = $collection->keyBy('product_id');

$keyed->all();

/*
  [
     '100' => ['product_id' => '100', 'name' => 'desk'],
     '200' => ['product_id' => '200', 'name' => 'chair'],
  ]
*/
```
You may also pass your own callback, which should return the value to key the collection by:
```php
$collection = new Collection([
    ['product_id' => '100', 'name' => 'desk'],
    ['product_id' => '200', 'name' => 'chair'],
]);

$keyed = $collection->keyBy(function ($item) {
    return strtoupper($item['name']);
});

$keyed->all();

/*
  [
    'DESK' => ['product_id' => '100', 'name' => 'desk'],
    'CHAIR' => ['product_id' => '200', 'name' => 'chair'],
  ]
*/
```

---------

#####```keys()```

Get the keys of the collection items:
```php
$collection = new Collection([
    'city' => 'New York',
    'country' => 'USA'
]);

$collection->keys();

// ['city', 'country']
```
---------

#####```map()```

Run a map over each of the items:
```php
$collection = new Collection([1, 2, 3, 4, 5]);

$multiplied = $collection->map(function ($item, $key) {
    return $item * 2;
});

$multiplied->all();

// [2, 4, 6, 8, 10]
```
---------
