<?php

declare (strict_types = 1);

namespace Luke\Game\Elements;

use Luke\Game\Exceptions\CannotRevealChipOnEmptyFieldException;
use Luke\Game\Exceptions\FieldAlreadyHasChipException;

/**
 * Class Field
 * @package Luke\Game
 */
class Field
{
    /** @var Chip */
    private $chip;

    /**
     * Field constructor.
     *
     * @param int $row
     * @param int $col
     */
    public function __construct(int $row, int $col)
    {
        $this->position = new Position($row, $col);
    }

    /**
     * @param Chip $chip
     *
     * @throws FieldAlreadyHasChipException
     */
    public function putChip(Chip $chip)
    {
        if (!$this->isEmpty()) {
            throw new FieldAlreadyHasChipException('Only one chip per field allowed.');
        }

        $this->chip = $chip;
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return !$this->chip instanceof Chip;
    }

    public function revealChip()
    {
        if ($this->isEmpty()) {
            throw new CannotRevealChipOnEmptyFieldException('This field has no chip to reveal.');
        }

        $this->chip->reveal();
    }

    /**
     * @return Position
     */
    public function getPosition(): Position
    {
        return $this->position;
    }
}
