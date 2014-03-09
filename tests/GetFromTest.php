<?php

namespace florinec;

class GetFromTest extends \PHPUnit_Framework_TestCase
{
    /** @dataProvider provideGetFrom */
    function testGetFrom($expected, $object, $keys, $default = null)
    {
        $this->assertEquals($expected, \florianec\get_from($object, $keys, $default));
    }

    function provideGetFrom()
    {
        $single = new \stdClass;
        $single->key = 'value';
        $nested = new \stdClass;
        $nested->foo = new \stdClass;
        $nested->foo->bar = new \stdClass;
        $nested->foo->bar->baz = 'value';
        $list = [new \stdClass];
        $list[0]->name = 'foo';

        $expected2 = new \stdClass;
        $expected2->bar = new \stdClass;
        $expected2->bar->baz = 'value';

        $expected3 = new \stdClass;
        $expected3->baz = 'value';

        return [
            ['value', $single, ['key'], 'default'],
            [$expected2, $nested, ['foo'], 'default'],
            [$expected3, $nested, ['foo', 'bar'], 'default'],
            ['value', $nested, ['foo', 'bar', 'baz'], 'default'],
            ['default', $nested, ['foo', 'bar', 'bang'], 'default'],
            ['default', $nested, ['non_existent'], 'default'],
            [null, $nested, ['non_existent']],
            [$nested, $nested, [], 'default'],
            [$nested, $nested, []],
            ['foo', $list, [0, 'name']],
            [null, ['foo' => null], ['foo'], 'err'],
        ];
    }
}
