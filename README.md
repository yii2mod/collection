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

//or via `make` function

$collection = Collection::make([1, 2, 3]);
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
29. **[max()](#max)**
30. **[merge()](#merge)**
31. **[min()](#min)**
32. **[only()](#only)**
33. **[pluck()](#pluck)**
34. **[pop()](#pop)**
35. **[prepend()](#prepend)**
36. **[pull()](#pull)**
37. **[push()](#push)**
38. **[put()](#put)**
39. **[random()](#random)**
40. **[reduce()](#reduce)**
41. **[reject()](#reject)**
42. **[reverse()](#reverse)**
43. **[search()](#search)**
44. **[shift()](#shift)**
45. **[shuffle()](#shuffle)**
46. **[slice()](#slice)**
47. **[sort()](#sort)**
48. **[sortBy()](#sortby)** 
49. **[sortByDesc()](#sortbydesc)** 
50. **[splice()](#splice)**
51. **[sum()](#sum)**
52. **[take()](#take)**
53. **[toArray()](#toarray)**
54. **[toJson()](#tojson)**
55. **[transform()](#transform)**
56. **[unique()](#unique)**
57. **[values()](#values)**
58. **[where()](#where)**
59. **[whereLoose()](#whereloose)**
60. **[whereIn()](#wherein)**
61. **[whereInLoose()](#whereinloose)**
62. **[zip()](#zip)**


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

#####```max()```

Get the max value of a given key:
```php
$collection = new Collection([['foo' => 10], ['foo' => 20]]);
$max = $collection->max('foo');

// 20

$collection = new Collection([1, 2, 3, 4, 5]);
$max = $collection->max();

// 5
```
---------

#####```merge()```

Merge the collection with the given items:
```php
$collection = new Collection(['product_id' => 1, 'name' => 'Desk']);

$merged = $collection->merge(['price' => 100, 'discount' => false]);

$merged->all();

// ['product_id' => 1, 'name' => 'Desk', 'price' => 100, 'discount' => false]
```
---------

#####```min()```

Get the min value of a given key:
```php
$collection = new Collection([['foo' => 10], ['foo' => 20]]);
$max = $collection->max('foo');

// 10

$collection = new Collection([1, 2, 3, 4, 5]);
$max = $collection->max();

// 1
```
---------

#####```only()```

Get the items with the specified keys:
```php
$collection = new Collection(['product_id' => 1, 'name' => 'Desk', 'price' => 100, 'discount' => false]);

$filtered = $collection->only(['product_id', 'name']);

$filtered->all();

// ['product_id' => 1, 'name' => 'Desk']
```
---------


#####```pluck()```

Get the values of a given key:
```php
$collection = new Collection([
    ['product_id' => 'prod-100', 'name' => 'Desk'],
    ['product_id' => 'prod-200', 'name' => 'Chair'],
]);

$plucked = $collection->pluck('name');

$plucked->all();

// ['Desk', 'Chair']
```

You may also specify how you wish the resulting collection to be keyed:

```php
$plucked = $collection->pluck('name', 'product_id');

$plucked->all();

// ['prod-100' => 'Desk', 'prod-200' => 'Chair']
```
---------

#####```pop()```

Get and remove the last item from the collection:
```php
$collection = new Collection([1, 2, 3, 4, 5]);

$collection->pop();
// 5

$collection->all();

// [1, 2, 3, 4]
```
---------

#####```prepend()```

Push an item onto the beginning of the collection:
```php
$collection = new Collection([1, 2, 3, 4, 5]);

$collection->prepend(0);

$collection->all();

// [0, 1, 2, 3, 4, 5]
```
---------

#####```pull()```

Get and remove an item from the collection:
```php
$collection = new Collection(['product_id' => 'prod-100', 'name' => 'Desk']);

$collection->pull('name');

// 'Desk'

$collection->all();

// ['product_id' => 'prod-100']
```
---------

#####```push()```

Push an item onto the end of the collection:
```php
$collection = new Collection([1, 2, 3, 4]);

$collection->push(5);

$collection->all();

// [1, 2, 3, 4, 5]
```
---------

#####```put()```

Put an item in the collection by key:
```php
$collection = new Collection(['product_id' => 1, 'name' => 'Desk']);

$collection->put('price', 100);

$collection->all();

// ['product_id' => 1, 'name' => 'Desk', 'price' => 100]
```
---------

#####```random()```

Desc:
```php
$collection = new Collection([1, 2, 3, 4, 5]);

$collection->random();

// 4 - (retrieved randomly)
```
You may optionally pass an integer to random. If that integer is more than 1, a collection of items is returned:

```php
$random = $collection->random(3);

$random->all();

// [2, 4, 5] - (retrieved randomly)
```
---------

#####```reduce()```

Reduce the collection to a single value:
```php
$collection = new Collection([1, 2, 3]);

$total = $collection->reduce(function ($carry, $item) {
    return $carry + $item;
});

// 6
```
The value for $carry on the first iteration is null; however, you may specify its initial value by passing a second argument to reduce:

```php
$collection->reduce(function ($carry, $item) {
    return $carry + $item;
}, 4);

// 10
```
---------

#####```reject()```

Create a collection of all elements that do not pass a given truth test:
```php
$collection = new Collection([1, 2, 3, 4]);

$filtered = $collection->reject(function ($value, $key) {
    return $value > 2;
});

$filtered->all();

// [1, 2]
```
---------

#####```reverse()```

Reverse items order:
```php
$collection = new Collection([1, 2, 3, 4, 5]);

$reversed = $collection->reverse();

$reversed->all();

// [5, 4, 3, 2, 1]
```
---------

#####```search()```

Search the collection for a given value and return the corresponding key if successful:
```php
$collection = new Collection([2, 4, 6, 8]);

$collection->search(4);

// 1
```
The search is done using a "loose" comparison. To use strict comparison, pass true as the second argument to the method:
```php
$collection->search('4', true);

// false
```
---------

#####```shift()```

Get and remove the first item from the collection:
```php
$collection = new Collection([1, 2, 3, 4, 5]);

$collection->shift();

// 1

$collection->all();

// [2, 3, 4, 5]
```
---------

#####```shuffle()```

Shuffle the items in the collection:
```php
$collection = new Collection([1, 2, 3, 4, 5]);

$shuffled = $collection->shuffle();

$shuffled->all();

// [3, 2, 5, 1, 4] // (generated randomly)
```
---------

#####```slice()```

Slice the underlying collection array:
```php
$collection = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

$slice = $collection->slice(4);

$slice->all();

// [5, 6, 7, 8, 9, 10]
```
If you would like to limit the size of the returned slice, pass the desired size as the second argument to the method:

```php
$slice = $collection->slice(4, 2);

$slice->all();

// [5, 6]
```
---------

#####```sort()```

Sort through each item with a callback:
```php
$collection = new Collection([5, 3, 1, 2, 4]);

$sorted = $collection->sort();

$sorted->values()->all();

// [1, 2, 3, 4, 5]
```
---------

#####```sortBy()```

Sort the collection using the given callback:
```php
$collection = new Collection([
    ['name' => 'Desk', 'price' => 200],
    ['name' => 'Chair', 'price' => 100],
    ['name' => 'Bookcase', 'price' => 150],
]);

$sorted = $collection->sortBy('price');

$sorted->values()->all();

/*
    [
        ['name' => 'Chair', 'price' => 100],
        ['name' => 'Bookcase', 'price' => 150],
        ['name' => 'Desk', 'price' => 200],
    ]
*/
```
You can also pass your own callback to determine how to sort the collection values:
```php
$collection = new Collection([
    ['name' => 'Desk', 'colors' => ['Black', 'Mahogany']],
    ['name' => 'Chair', 'colors' => ['Black']],
    ['name' => 'Bookcase', 'colors' => ['Red', 'Beige', 'Brown']],
]);

$sorted = $collection->sortBy(function ($product, $key) {
    return count($product['colors']);
});

$sorted->values()->all();

/*
    [
        ['name' => 'Chair', 'colors' => ['Black']],
        ['name' => 'Desk', 'colors' => ['Black', 'Mahogany']],
        ['name' => 'Bookcase', 'colors' => ['Red', 'Beige', 'Brown']],
    ]
*/
```
---------

#####```sortByDesc()```
This method has the same signature as the [sortBy()](#sortby) method, but will sort the collection in the opposite order.

---------

#####```splice()```

Splice a portion of the underlying collection array:
```php
$collection = new Collection([1, 2, 3, 4, 5]);

$chunk = $collection->splice(2);

$chunk->all();

// [3, 4, 5]

$collection->all();

// [1, 2]
```
You may pass a second argument to limit the size of the resulting chunk:
```php
$collection = new Collection([1, 2, 3, 4, 5]);

$chunk = $collection->splice(2, 1);

$chunk->all();

// [3]

$collection->all();

// [1, 2, 4, 5]
```
In addition, you can pass a third argument containing the new items to replace the items removed from the collection:
```php
$collection = new Collection([1, 2, 3, 4, 5]);

$chunk = $collection->splice(2, 1, [10, 11]);

$chunk->all();

// [3]

$collection->all();

// [1, 2, 10, 11, 4, 5]
```
---------

#####```sum()```

Get the sum of the given values:
```php
$collection = new Collection([1, 2, 3]);
        
$collection->sum();

// 6
```
If the collection contains nested arrays or objects, you should pass a key to use for determining which values to sum:
```php
$collection = new Collection([
    ['name' => 'Books', 'countOfProduct' => 100],
    ['name' => 'Chairs', 'countOfProduct' => 200],
]);

$collection->sum('countOfProduct');

// 300
```
In addition, you may pass your own callback to determine which values of the collection to sum:
```php
$collection = new Collection([
    ['name' => 'Chair', 'colors' => ['Black']],
    ['name' => 'Desk', 'colors' => ['Black', 'Mahogany']],
    ['name' => 'Bookcase', 'colors' => ['Red', 'Beige', 'Brown']],
]);

$collection->sum(function ($product) {
    return count($product['colors']);
});

// 6
```
---------

#####```take()```

Take the first or last {$limit} items:
```php
$collection = new Collection([0, 1, 2, 3, 4, 5]);

$chunk = $collection->take(3);

$chunk->all();

// [0, 1, 2]
```
You may also pass a negative integer to take the specified amount of items from the end of the collection:
```php
$collection = new Collection([0, 1, 2, 3, 4, 5]);

$chunk = $collection->take(-2);

$chunk->all();

// [4, 5]
```
---------

#####```toArray()```

Get the collection of items as a plain array:
```php
$collection = new Collection('name');

$collection->toArray();

/*
    ['name']
*/
```
> [toArray()](#toArray) also converts all of its nested objects to an array. If you want to get the underlying array as is, use the [all()](#all) method instead.

---------

#####```toJson()```

Get the collection of items as JSON:
```php
$collection = new Collection(['name' => 'Desk', 'price' => 200]);

$collection->toJson();

// '{"name":"Desk","price":200}'
```
---------

#####```transform()```

Transform each item in the collection using a callback:
```php
$collection = new Collection([1, 2, 3, 4, 5]);

$collection->transform(function ($item, $key) {
    return $item * 2;
});

$collection->all();

// [2, 4, 6, 8, 10]
```
> Unlike most other collection methods, [transform()](#transform) modifies the collection itself. If you wish to create a new collection instead, use the [map()](#map) method.

---------

#####```unique()```

Return only unique items from the collection array:
```php
$collection = new Collection([1, 1, 2, 2, 3, 4, 2]);

$unique = $collection->unique();

$unique->values()->all();

// [1, 2, 3, 4]
```

The returned collection keeps the original array keys. In this example we used the [values()](#values) method to reset the keys to consecutively numbered indexes.

When dealing with nested arrays or objects, you may specify the key used to determine uniqueness:

```php
$collection = new Collection([
    ['name' => 'iPhone 6', 'brand' => 'Apple', 'type' => 'phone'],
    ['name' => 'iPhone 5', 'brand' => 'Apple', 'type' => 'phone'],
    ['name' => 'Apple Watch', 'brand' => 'Apple', 'type' => 'watch'],
    ['name' => 'Galaxy S6', 'brand' => 'Samsung', 'type' => 'phone'],
    ['name' => 'Galaxy Gear', 'brand' => 'Samsung', 'type' => 'watch'],
]);

$unique = $collection->unique('brand');

$unique->values()->all();

/*
    [
        ['name' => 'iPhone 6', 'brand' => 'Apple', 'type' => 'phone'],
        ['name' => 'Galaxy S6', 'brand' => 'Samsung', 'type' => 'phone'],
    ]
*/
```
You may also pass your own callback to determine item uniqueness:

```php
$unique = $collection->unique(function ($item) {
    return $item['brand'].$item['type'];
});

$unique->values()->all();

/*
    [
        ['name' => 'iPhone 6', 'brand' => 'Apple', 'type' => 'phone'],
        ['name' => 'Apple Watch', 'brand' => 'Apple', 'type' => 'watch'],
        ['name' => 'Galaxy S6', 'brand' => 'Samsung', 'type' => 'phone'],
        ['name' => 'Galaxy Gear', 'brand' => 'Samsung', 'type' => 'watch'],
    ]
*/
```
---------

#####```values()```

Reset the keys on the underlying array:
```php
$collection = new Collection([
    10 => ['product' => 'Desk', 'price' => 200],
    11 => ['product' => 'Desk', 'price' => 200]
]);

$values = $collection->values();

$values->all();

/*
    [
        0 => ['product' => 'Desk', 'price' => 200],
        1 => ['product' => 'Desk', 'price' => 200],
    ]
*/
```
---------

#####```where()```

Filter items by the given key value pair:
```php
$collection = new Collection([
    ['product' => 'Desk', 'price' => 200],
    ['product' => 'Chair', 'price' => 100],
    ['product' => 'Bookcase', 'price' => 150],
    ['product' => 'Door', 'price' => 100],
]);

$filtered = $collection->where('price', 100);

$filtered->all();

/*
  [
     ['product' => 'Chair', 'price' => 100],
     ['product' => 'Door', 'price' => 100],
  ]
*/

```
The [where()](#where) method uses strict comparisons when checking item values. Use the whereLoose method to filter using [whereLoose()](#whereloose) comparisons.

---------

#####```whereLoose()```

This method has the same signature as the [where()](#where) method; however, all values are compared using "loose" comparisons.

---------

#####```whereIn()```

Filter the collection by a given key / value contained within the given array:
```php
$collection = new Collection([
    ['product' => 'Desk', 'price' => 200],
    ['product' => 'Chair', 'price' => 100],
    ['product' => 'Bookcase', 'price' => 150],
    ['product' => 'Door', 'price' => 100],
]);

$filtered = $collection->whereIn('price', [150, 200]);

$filtered->all();

/*
   [
      ['product' => 'Bookcase', 'price' => 150],
      ['product' => 'Desk', 'price' => 200],
   ]
*/
```
The [whereIn()](#wherein) method uses strict comparisons when checking item values. Use the [whereInLoose()](#whereinloose) method to filter using "loose" comparisons.

---------

#####```whereInLoose()```

This method has the same signature as the [whereIn()](#wherein) method; however, all values are compared using "loose" comparisons.

---------

#####```zip()```

Zip the collection together with one or more arrays:

```php
$collection = new Collection(['Chair', 'Desk']);

$zipped = $collection->zip([100, 200]);

$zipped->all();

// [['Chair', 100], ['Desk', 200]]
```
---------
