<?php

namespace Players;

/**
 * Trait PlayerAccessors
 * @package Players
 */
trait PlayerAccessors
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
     * @var array $defensiveSkills
     */
    private $defensiveSkills;

    /**
     * @var array $aggressiveSkills
     */
    private $aggressiveSkills;

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
     * Subtracts damage from player health.
     *
     * @param Player $attacker
     * @return mixed
     */
    public function takeHit(Player $attacker)
    {
        $damage = $this->getDamageSuffered($attacker);
        $this->health = $this->health - $damage;

        if ($this->health <= 0) {
            return self::KNOCKOUT_LOSER;
        }
    }

    /**
     * What damage should I suffer from this attacker?
     *
     * @param Player $attacker
     * @return int
     */
    public function getDamageSuffered(Player $attacker): int
    {
        return $attacker->getStrength() - $this->defence;
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
}
