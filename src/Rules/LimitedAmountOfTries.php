<?php

declare (strict_types = 1);

namespace Luke\Game\Rules;
use Luke\Game\Game;

/**
 * Class LimitedAmountOfTries
 * @package Luke\Game
 */
class LimitedAmountOfTries
{
    /** @var int */
    private $triesLimit;

    /**
     * LimitedAmountOfTries constructor.
     *
     * @param int $triesLimit
     */
    public function __construct(int $triesLimit)
    {
        $this->triesLimit = $triesLimit;
    }

    /**
     * @param Game $game
     *
     * @return bool
     */
    public function isFulfilled(Game $game): bool
    {

        return $game->movesDone() < $this->triesLimit;
    }
}
