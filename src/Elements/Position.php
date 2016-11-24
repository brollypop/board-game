<?php

declare (strict_types = 1);

namespace Luke\Game\Elements;

/**
 * Class Position
 * @package Luke\Game\Elements
 */
class Position
{
    /** @var int */
    private $row;
    /** @var int */
    private $col;

    /**
     * Position constructor.
     *
     * @param int $row
     * @param int $col
     */
    public function __construct(int $row, int $col)
    {
        $this->row = $row;
        $this->col = $col;
    }

    /**
     * @return int
     */
    public function getRow()
    {
        return $this->row;
    }

    /**
     * @return int
     */
    public function getCol()
    {
        return $this->col;
    }

    /**
     * @param Position $position
     *
     * @return bool
     */
    public function equals(Position $position)
    {
        return $this->getCol() === $position->getCol() && $this->getRow() === $position->getRow();
    }
}
