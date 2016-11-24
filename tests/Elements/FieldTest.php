<?php

declare (strict_types = 1);

namespace Luke\Game\Tests\Elements;

use Luke\Game\Elements\Chip;
use Luke\Game\Elements\Field;

/**
 * Class FieldTest
 * @package Luke\Game\Tests\Elements
 */
class FieldTest extends \PHPUnit_Framework_TestCase
{
    public function testChipCanBePutOnField()
    {
        $field = new Field(1, 1);

        self::assertTrue($field->isEmpty());

        $chip = new Chip();
        $field->putChip($chip);

        self::assertFalse($field->isEmpty());
    }

    public function testChipCanBeRevealed()
    {
        $field = new Field(1, 1);
        $chip = $this->createMock(Chip::class);
        $field->putChip($chip);

        $chip
            ->expects(self::once())
            ->method('reveal');

        $field->revealChip();
    }
}
