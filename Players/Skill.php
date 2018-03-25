<?php

namespace Players;

/**
 * Class Skill
 * @package Players
 */
class Skill
{
    /**
     * @var string $name
     */
    private $name;

    /**
     * How many times was it used.
     *
     * @var int $timesUsed
     */
    public $timesUsed;

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
     * Skill constructor.
     *
     * @param string $name
     * @param int $probability
     * @param int $possibleCases
     */
    public function __construct(
        string $name,
        int $probability,
        int $possibleCases
    ){
        $this->name = $name;
        $this->probability = $probability;
        $this->possibleCases = $possibleCases;
        $this->favorableCases = $this->getFavorableCases();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getFavorableCases(): int
    {
        $favorableCases = ($this->probability * $this->possibleCases) / 100;
        return round($favorableCases);
    }

    /**
     * @return int
     */
    public function getProbability(): int
    {
        return $this->probability;
    }

    /**
     * @return bool
     */
    public function apply(): bool
    {
        $favorableCases = $this->getFavorableCases();

        // The player has no more favorable cases left.
        if (in_array($favorableCases, [0, $this->timesUsed])) {
            return false;
        }

        // Reached here, so player still has favorable cases left.
        // This doesn't mean he uses all of them, it just means that
        // He can't get more then those. The rest is gamble.
        $useSkill = rand(0, 1);

        if ($useSkill) {
            $this->timesUsed++;
            return true;
        }

        return false;
    }
}
