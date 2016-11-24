<?php

declare (strict_types = 1);

namespace Luke\Game\Tests\Rules;

use Luke\Game\Game;
use Luke\Game\Rules\LimitedAmountOfTime;

/**
 * Class LimitedAmountOfTimeTest
 * @package Luke\Game\Tests\Rules
 */
class LimitedAmountOfTimeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var LimitedAmountOfTime
     */
    protected $rule;

    protected function setUp()
    {
        $this->rule = new LimitedAmountOfTime(60);
    }

    public function testIsFulfilledReturnsTrueWhenWithinLimit()
    {
        $gameStartTime = (new \DateTime('now'))->sub(new \DateInterval('PT55S'));
        $game = $this->createMock(Game::class);
        $game
            ->expects(self::any())
            ->method('getStartTime')
            ->willReturn($gameStartTime);

        self::assertTrue($this->rule->isFulfilled($game));
    }

    public function testIsFulfilledReturnsFalseWhenLimitExceeded()
    {
        $gameStartTime = (new \DateTime('now'))->sub(new \DateInterval('PT65S'));
        $game = $this->createMock(Game::class);
        $game
            ->expects(self::any())
            ->method('getStartTime')
            ->willReturn($gameStartTime);

        self::assertFalse($this->rule->isFulfilled($game));
    }
}
