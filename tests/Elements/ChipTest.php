<?php

declare (strict_types = 1);

namespace Luke\Game\Tests\Elements;

use Luke\Game\Elements\Chip;
use Luke\Game\Exceptions\ChipAlreadyRevealedException;
use Luke\Game\Exceptions\WinningChipRevealedException;

/**
 * Class ChipTest
 * @package Luke\Game\Tests\Elements
 */
class ChipTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Chip
     */
    protected $chip;

    protected function setUp()
    {
        $this->chip = new Chip();
    }

    public function testChipIsHiddenByDefault()
    {
        self::assertFalse($this->chip->isRevealed());
    }

    public function testChipIsLosingByDefault()
    {
        self::assertFalse($this->chip->isWinning());
    }

    public function testChipIsWinning()
    {
        $this->expectException(WinningChipRevealedException::class);

        $chip = new Chip(true);
        $chip->reveal();
    }

    public function testChipCanBeRevealed()
    {
        self::assertFalse($this->chip->isRevealed());

        $this->chip->reveal();

        self::assertTrue($this->chip->isRevealed());
    }

    public function testRevealedChipCannotBeRevealedAgain()
    {
        $this->expectException(ChipAlreadyRevealedException::class);

        $this->chip->reveal();
        $this->chip->reveal();
    }
}
