<?php

namespace Skills;

use Players\Player;

/**
 * Class MagicShield
 * @package Skills
 */
class MagicShield implements Skill
{
    /**
     * How many times was it used.
     *
     * @var int $timesUsed
     */
    private $timesUsed;

    /**
     * Total maximum cases
     * (Which is kinda' half of the game turns).
     *
     * @var int $possibleCases
     */
    private $possibleCases;

    /**
     * Based on the probability percentage, in
     * how many cases of the $possible cases will
     * this skill be used?
     *
     * @var int $totalUsageCases
     */
    private $favorableCases;

    /**
     * This is used as percentage.
     *
     * @var int $probability
     */
    private $probability;

    /**
     * Luck constructor.
     * @param int $probability
     * @param int $possibleCases
     */
    public function __construct(int $probability, int $possibleCases)
    {
        $this->probability = $probability;
        $this->possibleCases = $possibleCases;
        $this->favorableCases = $this->getFavorableCases();
    }

    /**
     * @param Player $player
     * @return mixed|void
     */
    public function apply(Player $player)
    {
        // TODO: Implement apply() method.
    }

    /**
     * @return float
     */
    private function getFavorableCases()
    {
        $favorableCases = ($this->probability * $this->possibleCases) / 100;
        return round($favorableCases);
    }
}
