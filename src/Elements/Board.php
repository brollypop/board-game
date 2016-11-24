<?php

declare (strict_types = 1);

namespace Luke\Game\Elements;

use Luke\Game\Exceptions\OutOfBoardBoundsException;

/**
 * Class Board
 * @package Luke\Game\Elements
 */
class Board
{
    /** @var Field[] */
    private $fields = [];
    /** @var int */
    private $rowsAmount;
    /** @var int */
    private $colsAmount;

    /**
     * Board constructor.
     *
     * @param int $rowsAmount
     * @param int $colsAmount
     */
    public function __construct(int $rowsAmount, int $colsAmount)
    {
        $this->rowsAmount = $rowsAmount;
        $this->colsAmount = $colsAmount;
        $this->generateFields();
    }

    private function generateFields()
    {
        for ($row = 1; $row <= $this->rowsAmount; ++$row) {
            for ($col = 1; $col <= $this->colsAmount; ++$col) {
                $this->fields["$row:$col"] = new Field($row, $col);
            }
        }
    }

    /**
     * @param Position $position
     *
     * @return Field
     */
    private function getField(Position $position)
    {
        $this->checkPosition($position);

        return $this->fields[sprintf('%d:%d', $position->getRow(), $position->getCol())];
    }

    /**
     * @param Position $position
     * @param Chip $chip
     */
    public function putChip(Position $position, Chip $chip)
    {
        $this->getField($position)->putChip($chip);
    }

    /**
     * @return Position[]
     */
    public function getPositions()
    {
        return array_map(function (Field $field) {
            return $field->getPosition();
        }, $this->fields);
    }

    /**
     * @param Position $position
     */
    public function revealChip(Position $position)
    {
        $this->getField($position)->revealChip();
    }

    /**
     * @param Position $position
     *
     * @throws OutOfBoardBoundsException
     */
    private function checkPosition(Position $position)
    {
        if (($position->getRow() < 1 || $position->getRow() > $this->rowsAmount)
            || ($position->getCol() < 1 || $position->getCol() > $this->colsAmount)
        ) {
            throw new OutOfBoardBoundsException('Position is out of board bounds.');
        }
    }
}
