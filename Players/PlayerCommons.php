<?php

namespace Players;

/**
 * Trait PlayerCommons
 * @package Players
 */
trait PlayerCommons
{
    /**
     * @var string $name
     */
    private $name;

    /**
     * @var int $health
     */
    private $health;

    /**
     * @var int $strength
     */
    private $strength;

    /**
     * @var int $defence
     */
    private $defence;

    /**
     * @var int $speed
     */
    private $speed;

    /**
     * @var int $consecutiveStrikes
     */
    private $consecutiveStrikes;

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
    public function getHealth(): int
    {
        return $this->health;
    }

    /**
     * What damage could I provoke to this defender?
     *
     * @param Player $defender
     * @return int
     */
    public function getDamagePower(Player $defender): int
    {
        return $this->strength - $defender->getDefence();
    }

    /**
     * @return int
     */
    public function getStrength(): int
    {
        return $this->strength;
    }

    /**
     * @return int
     */
    public function getDefence(): int
    {
        return $this->defence;
    }

    /**
     * @return int
     */
    public function getSpeed(): int
    {
        return $this->strength;
    }

    /**
     * @return Skill
     */
    public function getLuck(): Skill
    {
        return $this->luck;
    }
}
