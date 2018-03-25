<?php

declare(strict_types = 1);

use Players\Skill;
use Players\Player;
use Players\Monster;
use Game\Game;
use PHPUnit\Framework\TestCase;
use Players\PlayerCommons;

/**
 * Class PlayersTest
 */
class PlayersTest extends TestCase
{
    /**
     * @return Player
     */
    public function player()
    {
        return new class implements Player
        {
            use PlayerCommons;

            /** @var Skill $luck */
            private $luck;

            /** constructor. */
            public function __construct() {
                $this->name = 'Player ' . uniqid();
                $this->health = rand(70, 100);
                $this->strength = rand(70, 80);
                $this->defence = rand(45, 55);
                $this->speed = rand(40, 50);
                $this->consecutiveStrikes = 1;
                $turns = (int) round(Game::MAXIMUM_TURNS / 2);
                $this->luck = new Skill('Luck', rand(10, 30), $turns);
            }

            /** * @param int $damage */
            public function takeHit(int $damage) {
                $this->health = $this->health - $damage;
            }

            /** @param Player $defender */
            public function strike(Player $defender) {
                $damageApplied = $this->strength - $defender->getDefence();
                for ($i = 1; $i <= $this->consecutiveStrikes; $i++) {
                    $defender->takeHit($damageApplied);
                }
            }
        };
    }

    /**
     * Confirm strike() is working as expected on a scenario without any luck or skills.
     */
    public function test_strike_use_no_skill()
    {
        $roles = Game::getInitialRoles($this->player(), $this->player());

        /** @var Player $attacker */
        $attacker = $roles['attacker'];

        /** @var Player $defender */
        $defender = $roles['defender'];

        $damagePower = $attacker->getDamagePower($defender);
        $defenderHealthLeft = $defender->getHealth() - $damagePower;
        $attacker->strike($defender);
        $this->assertEquals($defenderHealthLeft, $defender->getHealth());
    }

    /**
     * Confirm takeHit() is working as expected on a scenario without any luck or skills.
     */
    public function test_take_hit_use_no_skill()
    {
        $player = $this->player();
        $healthBefore = $player->getHealth();
        $player->takeHit(30);
        $this->assertEquals(($healthBefore - 30), $player->getHealth());
    }

    /**
     * Confirm getDamagePower() returns an integer.
     */
    public function test_get_damage_power_returns_integer()
    {
        $dmg = $this->player()->getDamagePower(new Monster);
        $this->assertEquals('integer', gettype($dmg));
    }

    /**
     * Confirm getName() returns a string.
     */
    public function test_get_name_returns_string()
    {
        $this->assertEquals('string', gettype($this->player()->getName()));
    }

    /**
     * Confirm getHealth() returns an integer.
     */
    public function test_get_health_returns_integer()
    {
        $this->assertEquals('integer', gettype($this->player()->getHealth()));
    }

    /**
     * Confirm getStrength() returns an integer.
     */
    public function test_get_strength_returns_integer()
    {
        $this->assertEquals('integer', gettype($this->player()->getStrength()));
    }

    /**
     * Confirm getDefence() returns an integer.
     */
    public function test_get_defence_returns_integer()
    {
        $this->assertEquals('integer', gettype($this->player()->getDefence()));
    }

    /**
     * Confirm getSpeed() returns an integer.
     */
    public function test_get_speed_returns_integer()
    {
        $this->assertEquals('integer', gettype($this->player()->getSpeed()));
    }
}
