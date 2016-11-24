<?php

declare (strict_types = 1);

namespace Luke\Game\Tests\Elements;

use Luke\Game\Elements\Board;
use Luke\Game\Elements\Chip;
use Luke\Game\Elements\Position;
use Luke\Game\Exceptions\BoardMustHaveAtLeastOneFieldException;
use Luke\Game\Exceptions\OutOfBoardBoundsException;

/**
 * Class BoardTest
 * @package Luke\Game\Tests\Elements
 */
class BoardTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Board
     */
    protected $board;

    protected function setUp()
    {
        $this->board = new Board(4, 5);
    }

    public function testBoardMustHaveAtleastOneField()
    {
        $this->expectException(BoardMustHaveAtLeastOneFieldException::class);

        new Board(0, 0);
    }

    public function testChipCanBePutOnBoard()
    {
        $this->board->putChip(new Position(1, 1), new Chip());
    }

    public function testChipCannotBePutOutOfBoardBounds()
    {
        $this->expectException(OutOfBoardBoundsException::class);

        $this->board->putChip(new Position(5, 1), new Chip());
    }

    public function testChipCanBeRevealed()
    {
        $chip = $this->createMock(Chip::class);
        $this->board->putChip(new Position(2, 3), $chip);

        $chip
            ->expects(self::once())
            ->method('reveal');

        $this->board->revealChip(new Position(2, 3));
    }

    public function testChipCannotBeRevealedOutOfBoardBounds()
    {
        $this->expectException(OutOfBoardBoundsException::class);

        $this->board->revealChip(new Position(5, 1));
    }

    public function testGetPositionsForSingleFieldBoard()
    {
        $board = new Board(1, 1);

        self::assertEquals(['1:1' => new Position(1, 1)], $board->getPositions());
    }
}
