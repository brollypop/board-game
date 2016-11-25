<?php

declare (strict_types = 1);

namespace Luke\Game;

use Luke\Game\Elements\Board;
use Luke\Game\Elements\Chip;
use Luke\Game\Settings\GameSettings;
use Luke\Game\Elements\Position;
use Luke\Game\Exceptions\AmountOfTimeExceededException;
use Luke\Game\Exceptions\AmountOfTriesExceededException;
use Luke\Game\Exceptions\GameNotStartedYetException;
use Luke\Game\Rules\LimitedAmountOfTime;
use Luke\Game\Rules\LimitedAmountOfTries;

/**
 * Class Game
 * @package Luke\Game
 */
class Game
{
    const READY_TO_GO = 0;
    const IN_PROGRESS = 1;

    /** @var Board */
    private $board;
    /** @var \DateTime */
    private $startTime;
    /** @var int */
    private $state;
    /** @var int */
    private $movesDone;

    /**
     * Game constructor.
     *
     * @param GameSettings $gameSettings
     */
    public function __construct(GameSettings $gameSettings)
    {
        $this->limitedAmountOfTries = new LimitedAmountOfTries($gameSettings->triesLimit);
        $this->limitedAmountOfTime = new LimitedAmountOfTime($gameSettings->timeLimit);
        $this->board = new Board($gameSettings->boardRows, $gameSettings->boardCols);
        $this->state = self::READY_TO_GO;
        $this->movesDone = 0;
        $this->winningPosition = new Position(
            random_int(1, $gameSettings->boardRows),
            random_int(1, $gameSettings->boardCols)
        );
        $this->putChipsOnBoard();
    }

    private function putChipsOnBoard()
    {
        foreach ($this->board->getPositions() as $position) {
            $chip = $position->equals($this->winningPosition) ? new Chip(true) : new Chip();
            $this->board->putChip($position, $chip);
        }
    }

    public function start()
    {
        $this->startTime = new \DateTime('now');
        $this->state = self::IN_PROGRESS;
    }

    /**
     * @param int $row
     * @param int $col
     */
    public function revealChip(int $row, int $col)
    {
        $this->validateMove();

        $this->board->revealChip(new Position($row, $col));
        $this->movesDone++;
    }

    /**
     * @return int
     */
    public function movesDone(): int
    {
        return $this->movesDone;
    }

    /**
     * @return int
     */
    public function state(): int
    {
        return $this->state;
    }

    /**
     * @return \DateTime
     * @throws GameNotStartedYetException
     */
    public function getStartTime(): \DateTime
    {
        if ($this->state() !== self::IN_PROGRESS) {
            throw new GameNotStartedYetException('Game has not started yet.');
        }
        return $this->startTime;
    }

    private function validateMove()
    {
        if ($this->state !== self::IN_PROGRESS) {
            throw new GameNotStartedYetException('Game has not started yet.');
        }
        if (!$this->limitedAmountOfTime->isFulfilled($this)) {
            throw new AmountOfTimeExceededException('Game over, time limit exceeded !');
        }
        if (!$this->limitedAmountOfTries->isFulfilled($this)) {
            throw new AmountOfTriesExceededException('Game over, tries limit exceeded !');
        }
    }
}
