<?php

namespace Players;

use Skills\Luck;
use Game;

/**
 * Class Monster
 * @package Players
 */
class Monster implements Player
{
    /** Comply to Player Interface */
    use PlayerAccessors;

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
        $turns = round(Game::MAXIMUM_TURNS / 2);

        $this->defensiveSkills = (object) [
            'luck' => new Luck(rand(25, 40), $turns)
        ];
    }
}
