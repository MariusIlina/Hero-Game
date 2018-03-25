<?php

namespace Game;

use Players\Player;
use Players\Skill;

/**
 * Class Output
 * @package Game
 */
final class Output
{
    /**
     * Indicate that a skill is being used.
     *
     * @param Player $player
     * @param Skill $skill
     */
    public static function skillOutput(Player $player, Skill $skill)
    {
        print $player->getName() . ' is using ' . $skill->getName();
        print '. Usage chance: ' .$skill->getFavorableCases() . ' of ';
        print round(Game::MAXIMUM_TURNS / 2) . ' cases.' . PHP_EOL;
    }

    /**
     * Indicate that the player took a hit.
     *
     * @param Player $player
     * @param int $damage
     */
    public static function takeHitOutput(Player $player, int $damage)
    {
        print $player->getName() . ' takes the hit and ';
        print 'suffers a damage of ' . $damage . PHP_EOL;
    }

    /**
     * Who attacks who.
     *
     * @param Player $attacker
     * @param Player $defender
     */
    public static function explainRound(Player $attacker, Player $defender)
    {
        print PHP_EOL . $attacker->getName() . " hits ";
        print $defender->getName() . "." . PHP_EOL;
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
