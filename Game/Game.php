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
        self::explainRound($attacker, $defender);

        // Attacker strike
        $attacker->strike($defender);

        // Defender health after attack
        self::showDefenderHealth($attacker, $defender);

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

    /**
     * Who attacks who.
     *
     * @param Player $attacker
     * @param Player $defender
     */
    public static function explainRound(Player $attacker, Player $defender)
    {
        print PHP_EOL . $attacker->getName() . " hits "
            . $defender->getName() . "." . PHP_EOL;
    }

    /**
     * @param Player $attacker
     * @param Player $defender
     */
    public static function showDefenderHealth(Player $attacker, Player $defender)
    {
        print $defender->getName() . " remaining health: "
            . $defender->getHealth() . PHP_EOL . PHP_EOL;

        if ($defender->getHealth() <= 0) {
            die ($attacker->getName() . ' WINS BY KNOCKOUT');
        }
    }

    /**
     * Outputs the initial roles.
     *
     * @param Player $attacker
     * @param Player $defender
     */
    public static function explainInitialRoles(Player $attacker, Player $defender)
    {
        $attackerDamagePower = $attacker->getDamagePower($defender);
        $defenderDamagePower = $defender->getDamagePower($attacker);

        $mask = PHP_EOL . "%20.20s %50.50s \n";
        printf($mask, "START FIGHT ", "First attacker is: "
            . strtoupper($attacker->getName()) . PHP_EOL);

        $mask = "%15.15s %20.20s %20.20s \n";
        printf($mask, 'Property', $attacker->getName(), $defender->getName());
        printf($mask, '---------', '--------------', '--------------');
        printf($mask, 'Health', $attacker->getHealth(), $defender->getHealth());
        printf($mask, 'Strength', $attacker->getStrength(), $defender->getStrength());
        printf($mask, 'Defence', $attacker->getDefence(), $defender->getDefence());
        printf($mask, 'Speed', $attacker->getSpeed(), $defender->getSpeed());
        printf($mask, 'Damage power', $attackerDamagePower, $defenderDamagePower);
        print PHP_EOL;
    }
}
