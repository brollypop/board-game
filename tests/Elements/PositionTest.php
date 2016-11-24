<?php

declare (strict_types = 1);

namespace Luke\Game\Tests\Elements;

use Luke\Game\Elements\Position;

/**
 * Class PositionTest
 * @package Luke\Game\Tests\Elements
 */
class PositionTest extends \PHPUnit_Framework_TestCase
{
    public function testEqualsReturnsTrueWhenComparedToSamePosition()
    {
        $position = new Position(11, 22);
        self::assertTrue($position->equals(new Position(11, 22)));
    }

    public function testEqualsReturnsFalseWhenComparedToDifferentPosition()
    {
        $position = new Position(1, 22);
        self::assertFalse($position->equals(new Position(11, 22)));
    }
}
