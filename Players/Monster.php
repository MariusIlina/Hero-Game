<?php

namespace Players;

use Game\Game;


/**
 * Class Monster
 * @package Players
 */
class Monster implements Player
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
     * Monster constructor.
     */
    public function __construct()
    {
        $this->name = 'Monster';
        $this->health = rand(60, 90);
        $this->strength = rand(60, 90);
        $this->defence = rand(40, 60);
        $this->speed = rand(40, 60);
        $this->consecutiveStrikes = 1;

        // Load some skills
        $turns = round(Game::MAXIMUM_TURNS / 2);
        $this->luck = new Skill('Luck', rand(25, 40), $turns);
    }

    /**
     * Attacks the other player.
     *
     * @param Player $defender
     */
    public function strike(Player $defender)
    {
        $damageApplied = $this->strength - $defender->getDefence();

        for ($i = 1; $i <= $this->consecutiveStrikes; $i++) {
            $defender->takeHit($damageApplied);
        }
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
                round(Game::MAXIMUM_TURNS / 2) . ' cases. ' . PHP_EOL;

            return true;
        }

        return false;
    }
}
