<?php

namespace Game;

use Players\Player;

/**
 * Class Monster
 */
final class Game
{
    /** Game flow constants*/
    const TIME_BETWEEN_TURNS = 2;
    const MAXIMUM_TURNS = 20;

    /**
     * Run game.
     *
     * @param Player $attacker
     * @param Player $defender
     */
    public static function play(Player $attacker, Player $defender)
    {
        static $turn;

        if ($turn >= self::MAXIMUM_TURNS) {
            die('GAME OVER');
        }

        sleep(self::TIME_BETWEEN_TURNS);
        $turn++;

        // Who hits who?
        Output::explainRound($attacker, $defender);

        // Attacker strike
        $attacker->strike($defender);

        // Defender health after attack
        Output::showDefenderHealth($attacker, $defender);

        // Recurse to next turn, but reverse players
        self::play($defender, $attacker);
    }

    /**
     * Decides who attacks first, based on speed/luck.
     * Arguments order is not relevant.
     * 
     * @param Player $a
     * @param Player $b
     * @return array
     */
    public static function getInitialRoles(Player $a, Player $b): array
    {
        // The higher speed
        $roles = [
            'attacker' => $a->getSpeed() > $b->getSpeed() ? $a : $b,
            'defender' => $a->getSpeed() < $b->getSpeed() ? $a : $b
        ];

        // Is the speed equal? Use luck factor.
        if ($a->getSpeed() == $b->getSpeed()) {
            $aLuck = $a->getLuck()->getProbability();
            $bLuck = $b->getLuck()->getProbability();
            $roles = [
                'attacker' => $aLuck > $bLuck ? $a : $b,
                'defender' => $aLuck < $bLuck ? $a : $b
            ];
        }

        return $roles;
    }
}
