<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Collection Extension for Yii 2</h1>
    <br>
</p>

The `yii2mod\collection\Collection` class provides a fluent, convenient wrapper for working with arrays of data.

[![Latest Stable Version](https://poser.pugx.org/yii2mod/collection/v/stable)](https://packagist.org/packages/yii2mod/collection) [![Total Downloads](https://poser.pugx.org/yii2mod/collection/downloads)](https://packagist.org/packages/yii2mod/collection) [![License](https://poser.pugx.org/yii2mod/collection/license)](https://packagist.org/packages/yii2mod/collection)
[![Build Status](https://travis-ci.org/yii2mod/collection.svg?branch=master)](https://travis-ci.org/yii2mod/collection)

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

// or via `make` function

$collection = Collection::make([1, 2, 3]);
```

Available Methods
-------------------
* **[all()](#all)**
* **[avg()](#avg)**
* **[chunk()](#chunk)**
* **[collapse()](#collapse)**
* **[combine()](#combine)**
* **[contains()](#contains)**
* **[count()](#count)**
* **[diff()](#diff)**
* **[each()](#each)**
* **[every()](#every)**
* **[except()](#except)**
* **[filter()](#filter)**
* **[first()](#first)**
* **[last()](#last)**
* **[flatten()](#flatten)**
* **[flip()](#flip)**
* **[forget()](#forget)**
* **[forPage()](#forpage)**
* **[get()](#get)**
* **[groupBy()](#groupby)**
* **[has()](#has)**
* **[implode()](#implode)**
* **[intersect()](#intersect)**
* **[isEmpty()](#isempty)**
* **[isNotEmpty()](#isnotempty)**
* **[keyby()](#keyby)**
* **[keys()](#keys)**
* **[map()](#map)**
* **[max()](#max)**
* **[merge()](#merge)**
* **[min()](#min)**
* **[only()](#only)**
* **[pluck()](#pluck)**
* **[pop()](#pop)**
* **[prepend()](#prepend)**
* **[pull()](#pull)**
* **[push()](#push)**
* **[put()](#put)**
* **[random()](#random)**
* **[reduce()](#reduce)**
* **[reject()](#reject)**
* **[reverse()](#reverse)**
* **[search()](#search)**
* **[shift()](#shift)**
* **[shuffle()](#shuffle)**
* **[slice()](#slice)**
* **[sort()](#sort)**
* **[sortBy()](#sortby)** 
* **[sortByDesc()](#sortbydesc)** 
* **[splice()](#splice)**
* **[sum()](#sum)**
* **[take()](#take)**
* **[toArray()](#toarray)**
* **[tap()](#tap)**
* **[toJson()](#tojson)**
* **[transform()](#transform)**
* **[unique()](#unique)**
* **[uniqueStrict()](#uniquestrict)**
* **[values()](#values)**
* **[where()](#where)**
* **[whereLoose()](#whereloose)**
* **[whereIn()](#wherein)**
* **[whereInLoose()](#whereinloose)**
* **[zip()](#zip)**

Method Listing
-------------------
##### ```all()```

The `all` method simply returns the underlying array represented by the collection:
```php
$collection = new Collection([1, 2, 3]);
$collection->all();
// [1, 2, 3]
```
------

##### ```avg()```

The `avg` method returns the average of all items in the collection:
```php
$collection = new Collection([1, 2, 3, 4, 5]);
$collection->avg();
// 3
```
If the collection contains nested arrays or objects, you should pass a key to use for determining which values to calculate the average:
```php
$collection = new Collection([
    ['id' => 1, 'price' => 150],
    ['id' => 2, 'price' => 250],
]);

$collection->avg('price');

// 200
```
------

##### ```chunk()```

The `chunk` method breaks the collection into multiple, smaller collections of a given size:
```php
$collection = new Collection([1, 2, 3, 4, 5, 6, 7]);

$chunks = $collection->chunk(4);

$chunks->toArray();

// [[1, 2, 3, 4], [5, 6, 7]]
```
------

##### ```collapse()```

The `collapse` method collapses a collection of arrays into a flat collection:
```php
$collection = new Collection([[1, 2, 3], [4, 5, 6], [7, 8, 9]]);

$collapsed = $collection->collapse();

$collapsed->all();

// [1, 2, 3, 4, 5, 6, 7, 8, 9]
```
------

##### ```combine()```

Create a collection by using this collection for keys and another for its values:
```php
$collection = new Collection(['name', 'age']);

$combined = $collection->combine(['George', 29]);

$combined->all();

// ['name' => 'George', 'age' => 29]
```
------

##### ```contains()```

The `contains` method determines whether the collection contains a given item:
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

##### ```count()```

The `count` method returns the total number of items in the collection:
```php
$collection = new Collection([1, 2, 3, 4, 5]);

$collection->count();

// 5
```
------

##### ```diff()```

The `diff` method compares the collection against another collection or a plain PHP array:
```php
$collection = new Collection([1, 2, 3, 4, 5]);

$diff = $collection->diff([2, 4, 6, 8]);

$diff->all();

// [1, 3, 5]
```
------

##### ```each()```

The `each` method iterates over the items in the collection and passes each item to a given callback:
```php
$collection = $collection->each(function ($item, $key) {
    if (/* some condition */) {
        return false;
    }
});
```
------

##### ```every()```

The `every` method creates a new collection consisting of every n-th element:
```php
$collection = new Collection(['a', 'b', 'c', 'd', 'e', 'f']);

$collection->every(4);

// ['a', 'e']
```
You may optionally pass offset as the second argument:
```php
$collection->every(4, 1);

// ['b', 'f']
```
------

##### ```except()```

Get all items except for those with the specified keys:
```php
$collection = new Collection(['id' => 1, 'name' => 'Desk', 'price' => 100, 'discount' => false]);

$filtered = $collection->except(['price', 'discount']);

$filtered->all();

// ['id' => 1, 'name' => 'Desk']
```
For the inverse of `except`, see the [only](#only) method.

------

##### ```filter()```

The `filter` method filters the collection by a given callback, keeping only those items that pass a given truth test:
```php
$collection = new Collection([1, 2, 3, 4]);

$filtered = $collection->filter(function ($value, $key) {
    return $value > 2;
});

$filtered->all();

// [3, 4]
```
------

##### ```first()```

The `first` method returns the first element in the collection that passes a given truth test:
```php
Collection::make([1, 2, 3, 4])->first(function ($key, $value) {
    return $value > 2;
});

// 3
```
You may also call the first method with no arguments to get the first element in the collection. If the collection is empty, `null` is returned:
```php
$collection = new Collection([1, 2, 3, 4, 5]);

$collection->first();

// 1
```
------

##### ```last()```

The `last` method returns the last element in the collection that passes a given truth test:
```php
Collection::make([1, 2, 3, 4])->last(function ($key, $value) {
    return $value > 2;
});

// 4
```

You may also call the `last` method with no arguments to get the last element in the collection. If the collection is empty, `null` is returned:

```php
$collection = new Collection([1, 2, 3, 4, 5]);

$collection->last();

// 5
```
------

##### ```flatten()```

The `flatten` method flattens a multi-dimensional collection into a single dimension:
```php
$collection = new Collection(['language' => 'java', 'languages' => ['php', 'javascript']]);

$collection->flatten();

// ['java', 'php', 'javascript']
```
------

##### ```flip()```

The `flip` method swaps the collection's keys with their corresponding values:
```php
$collection = new Collection(['firstName' => 'Igor', 'lastName' => 'Chepurnoy']);

$collection->flip();

// ['Igor' => 'firstName', 'Chepurnoy' => 'lastName']
```
------

##### ```forget()```

The `forget` method removes an item from the collection by its key:
```php
$collection = new Collection(['firstName' => 'Igor', 'lastName' => 'Chepurnoy']);

$collection->forget('firstName');

$collection->all();

// ['lastName' => 'Chepurnoy']
```
> Unlike most other collection methods, `forget` does not return a new modified collection; it modifies the collection it is called on.

------

##### ```forPage()```

The `forPage` method returns a new collection containing the items that would be present on a given page number:

```php
$collection = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9]);

$chunk = $collection->forPage(2, 3);

$chunk->all();

// [4, 5, 6]
```
> The method requires the page number and the number of items to show per page, respectively.

---------

##### ```get()```

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
You may optionally pass a default value as the second argument:
```php
$collection->get('User.identity.email', false);

// false
```
---------

##### ```groupBy()```

The `groupBy` method groups the collection's items by a given key:
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
In addition to passing a string key, you may also pass a callback. The callback should return the value you wish to key the group by:
```php
$grouped = $collection->groupBy(function ($item, $key) {
    return substr($item['id'], -2);
});

/*
[
    '_2' => [
        ['id' => 'id_2', 'name' => 'Bob'],
        ['id' => 'id_2', 'name' => 'John'],
    ],
    '_3' => [
        ['id' => 'id_3', 'name' => 'Frank'],
    ],
]
*/
```


---------

##### ```has()```

The `has` method determines if a given key exists in the collection:
```php
$collection = new Collection(['id' => 1, 'name' => 'Igor']);

$collection->has('id');

// true

$collection->has('email');

// false
```
---------

##### ```implode()```

Concatenate values of a given key as a string:
```php
$collection = new Collection([
    ['account_id' => 1, 'name' => 'Ben'],
    ['account_id' => 2, 'name' => 'Bob'],
]);

$collection->implode('name', ', ');

// Ben, Bob
```

If the collection contains simple strings or numeric values, simply pass the "glue" as the only argument to the method:
```php
Collection::make(['Ben', 'Bob'])->implode(' and ')

// Ben and Bob
```

---------

##### ```intersect()```

The `intersect` method removes any values that are not present in the given array or collection:
```php
$collection = new Collection(['php', 'python', 'ruby']);

$intersect = $collection->intersect(['python', 'ruby', 'javascript']);

$intersect->all();

// [1 => 'python', 2 => 'ruby']
```
---------

##### ```isEmpty()```

The `isEmpty` method returns true if the collection is empty; otherwise, false is returned:
```php
$collection = (new Collection([]))->isEmpty();

// true
```
---------

##### ```isNotEmpty()```

The `isNotEmpty` method returns true if the collection is not empty; otherwise, false is returned:

```php
$collection = (new Collection([]))->isNotEmpty();

// false
```
---------

##### ```keyBy()```

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

##### ```keys()```

The `keys` method returns all of the collection's keys:
```php
$collection = new Collection([
    'city' => 'New York',
    'country' => 'USA'
]);

$collection->keys();

// ['city', 'country']
```
---------

##### ```map()```

The `map` method iterates through the collection and passes each value to the given callback. The callback is free to modify the item and return it, thus forming a new collection of modified items:
```php
$collection = new Collection([1, 2, 3, 4, 5]);

$multiplied = $collection->map(function ($item, $key) {
    return $item * 2;
});

$multiplied->all();

// [2, 4, 6, 8, 10]
```

> Like most other collection methods, `map` returns a new collection instance; it does not modify the collection it is called on. If you want to transform the original collection, use the [transform](#transform) method.

---------

##### ```max()```

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

##### ```merge()```

Merge the collection with the given items:
```php
$collection = new Collection(['product_id' => 1, 'name' => 'Desk']);

$merged = $collection->merge(['price' => 100, 'discount' => false]);

$merged->all();

// ['product_id' => 1, 'name' => 'Desk', 'price' => 100, 'discount' => false]
```
---------

##### ```min()```

Get the min value of a given key:
```php
$collection = new Collection([['foo' => 10], ['foo' => 20]]);
$min = $collection->min('foo');

// 10

$collection = new Collection([1, 2, 3, 4, 5]);
$min = $collection->min();

// 1
```
---------

##### ```only()```

The `only` method returns the items in the collection with the specified keys:
```php
$collection = new Collection(['product_id' => 1, 'name' => 'Desk', 'price' => 100, 'discount' => false]);

$filtered = $collection->only(['product_id', 'name']);

$filtered->all();

// ['product_id' => 1, 'name' => 'Desk']
```
---------


##### ```pluck()```

The `pluck` method retrieves all of the collection values for a given key:
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

##### ```pop()```

The `pop` method removes and returns the last item from the collection:
```php
$collection = new Collection([1, 2, 3, 4, 5]);

$collection->pop();
// 5

$collection->all();

// [1, 2, 3, 4]
```
---------

##### ```prepend()```

The `prepend` method adds an item to the beginning of the collection:
```php
$collection = new Collection([1, 2, 3, 4, 5]);

$collection->prepend(0);

$collection->all();

// [0, 1, 2, 3, 4, 5]
```

You can optionally pass a second argument to set the key of the prepended item:

```php
$collection = Collection::make(['one' => 1, 'two' => 2]);

$collection->prepend(0, 'zero');

$collection->all();

// ['zero' => 0, 'one' => 1, 'two', => 2]
```

---------

##### ```pull()```

The `pull` method removes and returns an item from the collection by its key:
```php
$collection = new Collection(['product_id' => 'prod-100', 'name' => 'Desk']);

$collection->pull('name');

// 'Desk'

$collection->all();

// ['product_id' => 'prod-100']
```
---------

##### ```push()```

Push an item onto the end of the collection:
```php
$collection = new Collection([1, 2, 3, 4]);

$collection->push(5);

$collection->all();

// [1, 2, 3, 4, 5]
```
---------

##### ```put()```

Put an item in the collection by key:
```php
$collection = new Collection(['product_id' => 1, 'name' => 'Desk']);

$collection->put('price', 100);

$collection->all();

// ['product_id' => 1, 'name' => 'Desk', 'price' => 100]
```
---------

##### ```random()```

The `random` method returns a random item from the collection:
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

##### ```reduce()```

The `reduce` method reduces the collection to a single value, passing the result of each iteration into the subsequent iteration:
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

##### ```reject()```

The `reject` method filters the collection using the given callback. The callback should return true for any items it wishes to remove from the resulting collection:
```php
$collection = new Collection([1, 2, 3, 4]);

$filtered = $collection->reject(function ($value, $key) {
    return $value > 2;
});

$filtered->all();

// [1, 2]
```
---------

##### ```reverse()```

The `reverse` method reverses the order of the collection's items:
```php
$collection = new Collection([1, 2, 3, 4, 5]);

$reversed = $collection->reverse();

$reversed->all();

// [5, 4, 3, 2, 1]
```
---------

##### ```search()```

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

##### ```shift()```

The `shift` method removes and returns the first item from the collection:
```php
$collection = new Collection([1, 2, 3, 4, 5]);

$collection->shift();

// 1

$collection->all();

// [2, 3, 4, 5]
```
---------

##### ```shuffle()```

Shuffle the items in the collection:
```php
$collection = new Collection([1, 2, 3, 4, 5]);

$shuffled = $collection->shuffle();

$shuffled->all();

// [3, 2, 5, 1, 4] // (generated randomly)
```
---------

##### ```slice()```

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

##### ```sort()```

Sort through each item with a callback:
```php
$collection = new Collection([5, 3, 1, 2, 4]);

$sorted = $collection->sort();

$sorted->values()->all();

// [1, 2, 3, 4, 5]
```
---------

##### ```sortBy()```

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

##### ```sortByDesc()```
This method has the same signature as the [sortBy()](#sortby) method, but will sort the collection in the opposite order.

---------

##### ```splice()```

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

##### ```sum()```

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

##### ```take()```

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

##### ```toArray()```

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

##### ```tap()```

The `tap` method passes the collection to the given callback, allowing you to "tap" into the collection at a specific point and do something with the items while not affecting the collection itself:

```php
$collection = new Collection([2, 4, 3, 1, 5]);
$result = $collection->sort()
    ->tap(function ($collection) {
        // Values after sorting
        var_dump($collection->values()->toArray());
    })
    ->shift();
// 1
```
---------

##### ```toJson()```

Get the collection of items as JSON:
```php
$collection = new Collection(['name' => 'Desk', 'price' => 200]);

$collection->toJson();

// '{"name":"Desk","price":200}'
```
---------

##### ```transform()```

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

##### ```unique()```

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

##### ```uniqueStrict()```

This method has the same signature as the `unique` method; however, all values are compared using "strict" comparisons.

---------

##### ```values()```

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

##### ```where()```

The `where` method filters the collection by a given key / value pair:
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

##### ```whereLoose()```

This method has the same signature as the [where()](#where) method; however, all values are compared using "loose" comparisons.

---------

##### ```whereIn()```

The `whereIn` method filters the collection by a given key / value contained within the given array.
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

##### ```whereInLoose()```

This method has the same signature as the [whereIn()](#wherein) method; however, all values are compared using "loose" comparisons.

---------

##### ```zip()```

The `zip` method merges together the values of the given array with the values of the collection at the corresponding index:

```php
$collection = new Collection(['Chair', 'Desk']);

$zipped = $collection->zip([100, 200]);

$zipped->all();

// [['Chair', 100], ['Desk', 200]]
```
---------
