<?php

namespace Players;

/**
 * Interface Player
 * @package Players
 */
interface Player
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return int
     */
    public function getHealth(): int;

    /**
     * Attacks the other player.
     *
     * @param Player $defender
     * @return bool
     */
    public function strike(Player $defender);

    /**
     * Subtracts damage from player health.
     *
     * @param int $damage
     * @return bool
     */
    public function takeHit(int $damage);

    /**
     * What damage could I provoke to this defender?
     *
     * @param Player $defender
     * @return int
     */
    public function getDamagePower(Player $defender): int;

    /**
     * @return int
     */
    public function getStrength(): int;

    /**
     * @return int
     */
    public function getDefence(): int;

    /**
     * @return int
     */
    public function getSpeed(): int;

    /**
     * @return Skill
     */
    public function getLuck(): Skill;
}
