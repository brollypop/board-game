<?php

declare (strict_types = 1);

namespace Luke\Game\Settings;

/**
 * Class GameSettings
 * @package Luke\Game\Settings
 */
class GameSettings
{
    /**
     * @var int
     */
    public $boardRows;
    /**
     * @var int
     */
    public $boardCols;
    /**
     * @var int
     */
    public $triesLimit;
    /**
     * @var int
     */
    public $timeLimit;

    /**
     * GameSettings constructor.
     *
     * @param int $boardRows
     * @param int $boardCols
     * @param int $triesLimit
     * @param int $timeLimit
     */
    public function __construct(int $boardRows, int $boardCols, int $triesLimit, int $timeLimit)
    {
        $this->boardRows = $boardRows;
        $this->boardCols = $boardCols;
        $this->triesLimit = $triesLimit;
        $this->timeLimit = $timeLimit;
    }
}
