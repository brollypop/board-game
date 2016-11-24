<?php

declare (strict_types = 1);

namespace Luke\Game\Tests\Rules;

use Luke\Game\Game;
use Luke\Game\Rules\LimitedAmountOfTries;

/**
 * Class LimitedAmountOfTriesTest
 * @package Luke\Game\Tests\Rules
 */
class LimitedAmountOfTriesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var LimitedAmountOfTries
     */
    protected $rule;

    protected function setUp()
    {
        $this->rule = new LimitedAmountOfTries(3);
    }

    public function testIsFulfilledReturnsTrueWhenWithinLimit()
    {
        $game = $this->createMock(Game::class);
        $game
            ->expects(self::any())
            ->method('movesDone')
            ->willReturn(2);

        self::assertTrue($this->rule->isFulfilled($game));
    }

    public function testIsFulfilledReturnsFalseWhenLimitExceeded()
    {
        $game = $this->createMock(Game::class);
        $game
            ->expects(self::any())
            ->method('movesDone')
            ->willReturn(3);

        self::assertFalse($this->rule->isFulfilled($game));
    }
}
