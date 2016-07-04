<?php

namespace yii2mod\collection\tests;

use yii2mod\collection\Collection;

/**
 * Class CollectionTest
 * @package yii2mod\collection\tests
 */
class CollectionTest extends TestCase
{
    public function testAll()
    {
        $collection = new Collection([1, 2, 3]);
        $this->assertEquals([1, 2, 3], $collection->all());
    }

    public function testAvg()
    {
        $collection = new Collection([1, 2, 3, 4, 5]);
        $this->assertEquals(3, $collection->avg());

        // test nested arrays
        $collection = new Collection([
            ['id' => 1, 'price' => 150],
            ['id' => 2, 'price' => 250],
        ]);
        $this->assertEquals(200, $collection->avg('price'));
    }

    public function testChunk()
    {
        $collection = new Collection([1, 2, 3, 4, 5, 6, 7]);
        $chunks = $collection->chunk(4);
        $this->assertEquals([
            [1, 2, 3, 4],
            [4 => 5, 5 => 6, 6 => 7]
        ], $chunks->toArray());
    }

    public function testCollapse()
    {
        $collection = new Collection([[1, 2, 3], [4, 5, 6], [7, 8, 9]]);
        $collapsed = $collection->collapse();
        $this->assertEquals([1, 2, 3, 4, 5, 6, 7, 8, 9], $collapsed->all());
    }

    public function testCombine()
    {
        $collection = new Collection(['name', 'age']);
        $combined = $collection->combine(['George', 29]);
        $this->assertEquals(['name' => 'George', 'age' => 29], $combined->all());
    }

    public function testContains()
    {
        $collection = new Collection(['city' => 'Alabama', 'country' => 'USA']);
        $this->assertTrue($collection->contains('Alabama'));
        $this->assertFalse($collection->contains('New York'));

        // test pass key/value
        $collection = new Collection([
            ['city' => 'Alabama'],
            ['city' => 'New York']
        ]);

        $this->assertTrue($collection->contains('city', 'New York'));
    }

    public function testCount()
    {
        $collection = new Collection([1, 2, 3, 4, 5]);
        $this->assertEquals(5, $collection->count());
    }

    public function testDiff()
    {
        $collection = new Collection([1, 2, 3, 4, 5]);
        $diff = $collection->diff([2, 4, 6, 8]);
        $this->assertEquals([1, 2 => 3, 4 => 5], $diff->all());
    }

    public function testEach()
    {
        $collection = new Collection([1, 10]);

        $collection->each(function ($item, $key) {
            if ($item == 1) {
                $this->assertEquals(1, $item);
            }
        });
    }

    public function testEvery()
    {
        $collection = new Collection(['a', 'b', 'c', 'd', 'e', 'f']);
        $this->assertEquals(['a', 'e'], $collection->every(4)->all());
    }

    public function testExcept()
    {
        $collection = new Collection(['id' => 1, 'name' => 'Desk', 'price' => 100, 'discount' => false]);
        $filtered = $collection->except(['price', 'discount']);
        $this->assertEquals(['id' => 1, 'name' => 'Desk'], $filtered->all());
    }

    public function testFilter()
    {
        $collection = new Collection([1, 2, 3, 4]);
        $filtered = $collection->filter(function ($value, $key) {
            return $value > 2;
        });
        $this->assertEquals([2 => 3, 3 => 4], $filtered->all());
    }

    public function testFirst()
    {
        // test closure
        $first = Collection::make([1, 2, 3, 4])->first(function ($key, $value) {
            return $value > 2;
        });

        $this->assertEquals(3, $first);

        // test without arguments
        $collection = new Collection([1, 2, 3, 4, 5]);
        $this->assertEquals(1, $collection->first());
    }

    public function testLast()
    {
        // test with closure
        $last = Collection::make([1, 2, 3, 4])->last(function ($key, $value) {
            return $value > 2;
        });
        $this->assertEquals(4, $last);

        // test without arguments
        $collection = new Collection([1, 2, 3, 4, 5]);
        $this->assertEquals(5, $collection->last());
    }

    public function testFlatten()
    {
        $collection = new Collection(['language' => 'java', 'languages' => ['php', 'javascript']]);
        $this->assertEquals(['java', 'php', 'javascript'], $collection->flatten()->all());
    }

    public function testFlip()
    {
        $collection = new Collection(['firstName' => 'Igor', 'lastName' => 'Chepurnoy']);
        $this->assertEquals(['Igor' => 'firstName', 'Chepurnoy' => 'lastName'], $collection->flip()->all());
    }

    public function testForget()
    {
        $collection = new Collection(['firstName' => 'Igor', 'lastName' => 'Chepurnoy']);
        $collection->forget('firstName');
        $this->assertEquals(['lastName' => 'Chepurnoy'], $collection->all());
    }

    public function testForPage()
    {
        $collection = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9]);
        $chunk = $collection->forPage(2, 3);
        $this->assertEquals([3 => 4, 4 => 5, 5 => 6], $chunk->all());
    }

    public function testGet()
    {
        $collection = new Collection([
            'User' => [
                'identity' => [
                    'id' => 1
                ]
            ]
        ]);
        $this->assertEquals(1, $collection->get('User.identity.id'));
    }

    public function testGroupBy()
    {
        $collection = new Collection([
            ['id' => 'id_2', 'name' => 'Bob'],
            ['id' => 'id_2', 'name' => 'John'],
            ['id' => 'id_3', 'name' => 'Frank'],
        ]);
        $grouped = $collection->groupBy('id');
        $this->assertEquals([
            'id_2' => [
                ['id' => 'id_2', 'name' => 'Bob'],
                ['id' => 'id_2', 'name' => 'John'],
            ],
            'id_3' => [
                ['id' => 'id_3', 'name' => 'Frank'],
            ],
        ], $grouped->toArray());

        // passing callback
        $grouped = $collection->groupBy(function ($item, $key) {
            return substr($item['id'], -2);
        });
        $this->assertEquals([
            '_2' => [
                ['id' => 'id_2', 'name' => 'Bob'],
                ['id' => 'id_2', 'name' => 'John'],
            ],
            '_3' => [
                ['id' => 'id_3', 'name' => 'Frank'],
            ],
        ], $grouped->toArray());
    }

    public function testHas()
    {
        $collection = new Collection(['id' => 1, 'name' => 'Igor']);
        $this->assertTrue($collection->has('id'));
        $this->assertFalse($collection->has('email'));
    }

    public function testImplode()
    {
        $collection = new Collection([
            ['account_id' => 1, 'name' => 'Ben'],
            ['account_id' => 2, 'name' => 'Bob'],
        ]);

        $this->assertEquals('Ben, Bob', $collection->implode('name', ', '));
    }

    public function testIntersect()
    {
        $collection = new Collection(['php', 'python', 'ruby']);
        $intersect = $collection->intersect(['python', 'ruby', 'javascript']);
        $this->assertEquals([1 => 'python', 2 => 'ruby'], $intersect->all());
    }

    public function testIsEmpty()
    {
        $this->assertTrue($collection = (new Collection([]))->isEmpty());
        $this->assertFalse($collection = (new Collection([1, 2, 3]))->isEmpty());
    }

    public function testKeyBy()
    {
        $collection = new Collection([
            ['product_id' => '100', 'name' => 'desk'],
            ['product_id' => '200', 'name' => 'chair'],
        ]);
        $keyed = $collection->keyBy('product_id');
        $this->assertEquals([
            '100' => ['product_id' => '100', 'name' => 'desk'],
            '200' => ['product_id' => '200', 'name' => 'chair'],
        ], $keyed->all());

        // test callback
        $collection = new Collection([
            ['product_id' => '100', 'name' => 'desk'],
            ['product_id' => '200', 'name' => 'chair'],
        ]);

        $keyed = $collection->keyBy(function ($item) {
            return strtoupper($item['name']);
        });

        $this->assertEquals([
            'DESK' => ['product_id' => '100', 'name' => 'desk'],
            'CHAIR' => ['product_id' => '200', 'name' => 'chair'],
        ], $keyed->all());
    }

    public function testKeys()
    {
        $collection = new Collection([
            'city' => 'New York',
            'country' => 'USA'
        ]);
        $this->assertEquals(['city', 'country'], $collection->keys()->all());
    }

    public function testMap()
    {
        $collection = new Collection([1, 2, 3, 4, 5]);
        $multiplied = $collection->map(function ($item, $key) {
            return $item * 2;
        });
        $this->assertEquals([2, 4, 6, 8, 10], $multiplied->all());
    }

    public function testMax()
    {
        // test associative array
        $collection = new Collection([['foo' => 10], ['foo' => 20]]);
        $this->assertEquals(20, $collection->max('foo'));

        // test simple array
        $collection = new Collection([1, 2, 3, 4, 5]);
        $this->assertEquals(5, $collection->max());
    }

    public function testMerge()
    {
        $collection = new Collection(['product_id' => 1, 'name' => 'Desk']);
        $merged = $collection->merge(['price' => 100, 'discount' => false]);
        $this->assertEquals(['product_id' => 1, 'name' => 'Desk', 'price' => 100, 'discount' => false], $merged->all());
    }

    public function testMin()
    {
        // test associative array
        $collection = new Collection([['foo' => 10], ['foo' => 20]]);
        $this->assertEquals(10, $collection->min('foo'));

        // test simple array
        $collection = new Collection([1, 2, 3, 4, 5]);
        $this->assertEquals(1, $collection->min());
    }

    public function testOnly()
    {
        $collection = new Collection(['product_id' => 1, 'name' => 'Desk', 'price' => 100, 'discount' => false]);
        $filtered = $collection->only(['product_id', 'name']);
        $this->assertEquals(['product_id' => 1, 'name' => 'Desk'], $filtered->all());
    }

    public function testPluck()
    {
        $collection = new Collection([
            ['product_id' => 'prod-100', 'name' => 'Desk'],
            ['product_id' => 'prod-200', 'name' => 'Chair'],
        ]);
        $plucked = $collection->pluck('name');
        $this->assertEquals(['Desk', 'Chair'], $plucked->all());

        // specify how you wish the resulting collection to be keyed
        $plucked = $collection->pluck('name', 'product_id');
        $this->assertEquals(['prod-100' => 'Desk', 'prod-200' => 'Chair'], $plucked->all());
    }

    public function testPop()
    {
        $collection = new Collection([1, 2, 3, 4, 5]);
        $collection->pop();
        $this->assertEquals([1, 2, 3, 4], $collection->all());
    }

    public function testPrepend()
    {
        $collection = new Collection([1, 2, 3, 4, 5]);
        $collection->prepend(0);
        $this->assertEquals([0, 1, 2, 3, 4, 5], $collection->all());
    }

    public function testPull()
    {
        $collection = new Collection(['product_id' => 'prod-100', 'name' => 'Desk']);
        $collection->pull('name');
        $this->assertEquals(['product_id' => 'prod-100'], $collection->all());
    }

    public function testPush()
    {
        $collection = new Collection([1, 2, 3, 4]);
        $collection->push(5);
        $this->assertEquals([1, 2, 3, 4, 5], $collection->all());
    }

    public function testPut()
    {
        $collection = new Collection(['product_id' => 1, 'name' => 'Desk']);
        $collection->put('price', 100);
        $this->assertEquals(['product_id' => 1, 'name' => 'Desk', 'price' => 100], $collection->all());
    }

    public function testRandom()
    {
        $collection = new Collection([1, 2, 3, 4, 5]);
        $this->assertContains($collection->random(), $collection->all());
    }

    public function testReduce()
    {
        $collection = new Collection([1, 2, 3]);
        $total = $collection->reduce(function ($carry, $item) {
            return $carry + $item;
        });
        $this->assertEquals(6, $total);
    }

    public function testReject()
    {
        $collection = new Collection([1, 2, 3, 4]);
        $filtered = $collection->reject(function ($value, $key) {
            return $value > 2;
        });
        $this->assertEquals([1, 2], $filtered->all());
    }

    public function testReverse()
    {
        $collection = new Collection([1, 2, 3, 4]);
        $reversed = $collection->reverse();
        $this->assertEquals([3 => 4, 2 => 3, 1 => 2, 0 => 1], $reversed->all());
    }

    public function testSearch()
    {
        $collection = new Collection([2, 4, 6, 8]);
        $this->assertEquals(1, $collection->search(4));
        $this->assertFalse($collection->search(10));
    }

    public function testShift()
    {
        $collection = new Collection([1, 2, 3, 4, 5]);
        $collection->shift();
        $this->assertEquals([2, 3, 4, 5], $collection->all());
    }

    public function testSlice()
    {
        $collection = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);
        $slice = $collection->slice(4);
        $this->assertEquals([4 => 5, 5 => 6, 6 => 7, 7 => 8, 8 => 9, 9 => 10], $slice->all());
    }

    public function testSort()
    {
        $collection = new Collection([5, 3, 1, 2, 4]);
        $sorted = $collection->sort();
        $this->assertEquals([1, 2, 3, 4, 5], $sorted->values()->all());
    }

    public function testSortBy()
    {
        $collection = new Collection([
            ['name' => 'Desk', 'price' => 200],
            ['name' => 'Chair', 'price' => 100],
            ['name' => 'Bookcase', 'price' => 150],
        ]);

        $sorted = $collection->sortBy('price');
        $this->assertEquals([
            ['name' => 'Chair', 'price' => 100],
            ['name' => 'Bookcase', 'price' => 150],
            ['name' => 'Desk', 'price' => 200],
        ], $sorted->values()->all());
    }

    public function testSplice()
    {
        $collection = new Collection([1, 2, 3, 4, 5]);
        $chunk = $collection->splice(2);
        $this->assertEquals([3, 4, 5], $chunk->all());
        $this->assertEquals([1, 2], $collection->all());
    }

    public function testSum()
    {
        $collection = new Collection([1, 2, 3]);
        $this->assertEquals(6, $collection->sum());
    }

    public function testTake()
    {
        $collection = new Collection([0, 1, 2, 3, 4, 5]);
        $chunk = $collection->take(3);
        $this->assertEquals([0, 1, 2], $chunk->all());
    }

    public function testToArray()
    {
        $collection = new Collection('name');
        $this->assertEquals(['name'], $collection->toArray());
    }

    public function testToJson()
    {
        $collection = new Collection(['name' => 'Desk', 'price' => 200]);
        $this->assertEquals(json_encode(['name' => 'Desk', 'price' => 200]), $collection->toJson());
    }

    public function testTransform()
    {
        $collection = new Collection([1, 2, 3, 4, 5]);
        $collection->transform(function ($item, $key) {
            return $item * 2;
        });
        $this->assertEquals([2, 4, 6, 8, 10], $collection->all());
    }

    public function testUnique()
    {
        $collection = new Collection([1, 1, 2, 2, 3, 4, 2]);
        $unique = $collection->unique();
        $this->assertEquals([1, 2, 3, 4], $unique->values()->all());
    }

    public function testValues()
    {
        $collection = new Collection([
            10 => ['product' => 'Desk', 'price' => 200],
            11 => ['product' => 'Desk', 'price' => 200]
        ]);
        $values = $collection->values();
        $this->assertEquals([
            0 => ['product' => 'Desk', 'price' => 200],
            1 => ['product' => 'Desk', 'price' => 200],
        ], $values->all());
    }

    public function testWhere()
    {
        $collection = new Collection([
            ['product' => 'Desk', 'price' => 200],
            ['product' => 'Chair', 'price' => 100],
            ['product' => 'Bookcase', 'price' => 150],
            ['product' => 'Door', 'price' => 100],
        ]);

        $filtered = $collection->where('price', 100);

        $this->assertEquals([
            1 => ['product' => 'Chair', 'price' => 100],
            3 => ['product' => 'Door', 'price' => 100],
        ], $filtered->all());
    }

    public function testWhereIn()
    {
        $collection = new Collection([
            ['product' => 'Desk', 'price' => 200],
            ['product' => 'Chair', 'price' => 100],
            ['product' => 'Bookcase', 'price' => 150],
            ['product' => 'Door', 'price' => 100],
        ]);
        $filtered = $collection->whereIn('price', [150, 200]);
        $this->assertEquals([
            2 => ['product' => 'Bookcase', 'price' => 150],
            0 => ['product' => 'Desk', 'price' => 200],
        ], $filtered->all());
    }

    public function testZip()
    {
        $collection = new Collection(['Chair', 'Desk']);
        $zipped = $collection->zip([100, 200]);
        $this->assertEquals([['Chair', 100], ['Desk', 200]], $zipped->toArray());
    }
}