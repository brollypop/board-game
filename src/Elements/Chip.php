<?php

declare (strict_types = 1);

namespace Luke\Game\Elements;

use Luke\Game\Exceptions\ChipAlreadyRevealedException;
use Luke\Game\Exceptions\WinningChipRevealedException;

/**
 * Class Chip
 * @package Luke\Game\Elements
 */
class Chip
{
    /** @var bool */
    private $isWinning;
    /** @var bool */
    private $isRevealed;

    /**
     * Chip constructor.
     *
     * @param bool $isWinning
     */
    public function __construct(bool $isWinning = false)
    {
        $this->isRevealed = false;
        $this->isWinning = $isWinning;
    }

    public function reveal()
    {
        if ($this->isRevealed === true) {
            throw new ChipAlreadyRevealedException('Chip has been already revealed.');
        }
        $this->isRevealed = true;

        if ($this->isWinning()) {
            throw new WinningChipRevealedException('You have revealed the winning chip!');
        }
    }

    /**
     * @return boolean
     */
    public function isRevealed(): bool
    {
        return $this->isRevealed;
    }

    /**
     * @return boolean
     */
    public function isWinning(): bool
    {
        return $this->isWinning;
    }
}
