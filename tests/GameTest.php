<?php

declare (strict_types = 1);

namespace Luke\Game\Tests;

use Luke\Game\Exceptions\WinningChipRevealedException;
use Luke\Game\Settings\GameSettings;
use Luke\Game\Exceptions\AmountOfTimeExceededException;
use Luke\Game\Exceptions\AmountOfTriesExceededException;
use Luke\Game\Exceptions\GameNotStartedYetException;
use Luke\Game\Game;

/**
 * Class GameTest
 * @package Luke\Game
 */
class GameTest extends \PHPUnit_Framework_TestCase
{
    /** @var Game */
    private $game;

    protected function setUp()
    {
        $this->game = new Game(new GameSettings(4, 5, 5, 60));
    }

    public function testStartGame()
    {
        self::assertEquals(Game::READY_TO_GO, $this->game->state());
        $this->game->start();

        self::assertEquals(Game::IN_PROGRESS, $this->game->state());
    }

    public function testPlayerCantRevealChipsIfGameNotStarted()
    {
        $this->expectException(GameNotStartedYetException::class);
        self::assertEquals(Game::READY_TO_GO, $this->game->state());

        $this->game->revealChip(1, 1);
    }

    public function testPlayerCantRevealChipsIfHeDoesNotHaveTriesLeft()
    {
        $game = new Game(new GameSettings(4, 5, 0, 60));

        $this->expectException(AmountOfTriesExceededException::class);

        $game->start();
        $game->revealChip(1, 2);
    }

    public function testPlayerCannotRevealChipsAfterTimeEnds()
    {
        $game = new Game(new GameSettings(4, 5, 5, 1));

        $this->expectException(AmountOfTimeExceededException::class);

        $game->start();
        sleep(2);
        $game->revealChip(1, 1);
    }

    public function testPlayerShouldAlwaysWinOnSingleFieldBoard()
    {
        $game = new Game(new GameSettings(1, 1, 1, 5));

        $this->expectException(WinningChipRevealedException::class);

        $game->start();
        $game->revealChip(1, 1);
    }
}
