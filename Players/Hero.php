<?php

namespace Players;

use Game\Game;

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
     * @return int
     */
    public function strike(Player $defender)
    {
        $damageApplied = $this->strength - $defender->getDefence();
        $consecutiveStrikes = $this->tryRapidStrike();

        for ($i = 1; $i <= $consecutiveStrikes; $i++) {
            $defender->takeHit($damageApplied);
        }

        return $consecutiveStrikes;
    }

    /**
     * Subtracts damage from player health.
     *
     * @param int $damage
     * @return bool
     */
    public function takeHit(int $damage)
    {
        if ($this->tryLuck()) {
            return false;
        }

        if ($this->tryMagicShield()) {
            $damage = $damage / 2;
        }

        $this->health = $this->health - $damage;

        print $this->getName() . ' takes the hit and ' .
            'suffers a damage of ' . $damage . PHP_EOL;

        return true;
    }

    /**
     * Try to dodge a bullet!
     *
     * @return bool
     */
    private function tryLuck()
    {
        if ($this->luck->apply()) {
            print $this->name . ' is using LUCK. Usage chance: ' .
                $this->luck->getFavorableCases() . ' of ' .
                round(Game::MAXIMUM_TURNS / 2) . ' cases.' . PHP_EOL;

            return true;
        }

        return false;
    }

    /**
     * Try to strike more than once in a row!
     *
     * @return int
     */
    private function tryRapidStrike()
    {
        $consecutiveStrikes = $this->consecutiveStrikes;
        if ($this->rapidStrike->apply()) {
            $consecutiveStrikes++;
            print 'USING ' . $this->rapidStrike->getName() . " (strike twice)" . PHP_EOL;
        }

        return $consecutiveStrikes;
    }

    /**
     * Try cut the damage to half!
     *
     * @return bool
     */
    private function tryMagicShield()
    {
        if ($this->magicShield->apply()) {
            print $this->name . ' is using MAGIC SHIELD. Usage chance ' .
                $this->magicShield->getFavorableCases() . ' of ' .
                round(Game::MAXIMUM_TURNS / 2) . ' cases.' . PHP_EOL;

            return true;
        }

        return false;
    }
}
