<?php

declare(strict_types = 1);

use Game\Game;
use Players\Hero;
use Players\Monster;
use PHPUnit\Framework\TestCase;

/**
 * Class GameTest
 */
class GameTest extends TestCase
{
    /**
     * @var \Players\Player $playerA
     */
    private $playerA;

    /**
     * @var \Players\Player $playerB
     */
    private $playerB;

    /**
     * Run before each tests
     */
    public function setUp()
    {
        $this->playerA = new Hero;
        $this->playerB = new Monster;
        parent::setUp();
    }

    /**
     * Player with the highest speed should attack first.
     * Doesn't cover speed equality and fallback to luck-factor.
     */
    public function test_get_initial_roles()
    {
        $roles = Game::getInitialRoles($this->playerA, $this->playerB);

        $speedA = $this->playerA->getSpeed();
        $speedB = $this->playerB->getSpeed();

        if ($speedA > $speedB) {
            $this->assertEquals($this->playerA->getName(), $roles['attacker']->getName());
        }

        if ($speedA < $speedB) {
            $this->assertEquals($this->playerA->getName(), $roles['defender']->getName());
        }
    }
}
