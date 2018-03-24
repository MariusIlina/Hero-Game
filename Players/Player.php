<?php

namespace Players;

/**
 * Interface Player
 * @package Players
 */
interface Player
{
    const KNOCKOUT_LOSER = 100;
    const DEFENDER_GOT_LUCKY = 101;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return int
     */
    public function getHealth(): int;

    /**
     * Subtracts damage from player health.
     *
     * @param Player $attacker
     * @return bool
     */
    public function takeHit(Player $attacker);

    /**
     * What damage should I suffer from this attacker?
     *
     * @param Player $attacker
     * @return int
     */
    public function getDamageSuffered(Player $attacker): int;

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
}
