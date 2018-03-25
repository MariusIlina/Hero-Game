<?php

namespace Players;

use Game\Game;
use Game\Output;

/**
 * Class Hero
 * @package Players
 */
class Hero implements Player
{
    /**
     * Comply to Player Interface
     */
    use PlayerCommons;

    /**
     * @var Skill $luck
     */
    private $luck;

    /**
     * @var Skill $magicShield
     */
    private $magicShield;

    /**
     * @var Skill $rapidStrike
     */
    private $rapidStrike;

    /**
     * Hero constructor.
     */
    public function __construct()
    {
        $this->name = 'Orderus';
        $this->health = rand(70, 100);
        $this->strength = rand(70, 80);
        $this->defence = rand(45, 55);
        $this->speed = rand(40, 50);
        $this->consecutiveStrikes = 1;

        // Load some skills
        $turns = round(Game::MAXIMUM_TURNS / 2);
        $this->luck = new Skill('Luck', rand(10, 30), $turns);
        $this->magicShield = new Skill('Magic Shield', 20, $turns);
        $this->rapidStrike = new Skill('Rapid Strike', 10, $turns);
    }

    /**
     * Attacks the other player.
     *
     * @param Player $defender
     */
    public function strike(Player $defender)
    {
        $damageApplied = $this->strength - $defender->getDefence();
        $consecutiveStrikes = $this->tryRapidStrike();

        for ($i = 1; $i <= $consecutiveStrikes; $i++) {
            $defender->takeHit($damageApplied);
        }
    }

    /**
     * Subtracts damage from player health.
     *
     * @param int $damage
     */
    public function takeHit(int $damage)
    {
        $damage = $this->tryMagicShield($damage);
        $damage = $this->tryLuck($damage);

        $this->health = $this->health - $damage;
        Output::takeHitOutput($this, $damage);
    }

    /**
     * Try to dodge a bullet!
     *
     * @param int $damage
     * @return mixed
     */
    private function tryLuck(int $damage): int
    {
        if ($this->luck->apply()) {
            Output::skillOutput($this, $this->luck);

            return 0;
        }

        return $damage;
    }

    /**
     * Try to strike more than once in a row!
     *
     * @return int
     */
    private function tryRapidStrike(): int
    {
        $consecutiveStrikes = $this->consecutiveStrikes;
        if ($this->rapidStrike->apply()) {
            $consecutiveStrikes++;
            Output::skillOutput($this, $this->rapidStrike);
        }

        return $consecutiveStrikes;
    }

    /**
     * Try cut the damage to half!
     *
     * @param int $damage
     * @return int
     */
    private function tryMagicShield(int $damage): int
    {
        if ($this->magicShield->apply()) {
            Output::skillOutput($this, $this->magicShield);

            return $damage / 2;
        }

        return $damage;
    }
}
