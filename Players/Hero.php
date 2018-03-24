<?php

namespace Players;

use Game;
use Skills\Luck;
use Skills\MagicShield;
use Skills\RapidStrike;

/**
 * Class Hero
 * @package Players
 */
class Hero implements Player
{
    /** Comply to Player Interface */
    use PlayerAccessors;

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
        $turns = round(Game::MAXIMUM_TURNS / 2);

        $this->defensiveSkills = (object) [
            'luck' => new Luck(rand(10, 30), $turns),
            'magicShield' => new MagicShield(20, $turns)
        ];

        $this->aggressiveSkills = (object) [
            'doubleStrike' => new RapidStrike(10, $turns)
        ];
    }
}
