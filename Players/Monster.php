<?php

namespace Players;

use Game\Game;
use Game\Output;


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
     */
    public function takeHit(int $damage)
    {
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
}
