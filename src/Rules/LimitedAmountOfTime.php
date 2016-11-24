<?php

declare (strict_types = 1);

namespace Luke\Game\Rules;
use Luke\Game\Game;

/**
 * Class LimitedAmountOfTime
 * @package Luke\Game\Rules
 */
class LimitedAmountOfTime
{
    /** @var int */
    private $secondsLimit;

    /**
     * LimitedAmountOfTimeTest constructor.
     *
     * @param int $secondsLimit
     */
    public function __construct(int $secondsLimit)
    {
        $this->secondsLimit = $secondsLimit;
    }

    /**
     * @param Game $game
     *
     * @return bool
     */
    public function isFulfilled(Game $game)
    {
        $currentTime = new \DateTime('now');
        $gameStartTime = $game->getStartTime();

        $interval = $currentTime->getTimestamp() - $gameStartTime->getTimestamp();

        return $interval <= $this->secondsLimit;
    }
}
