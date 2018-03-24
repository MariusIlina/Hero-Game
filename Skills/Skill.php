<?php

namespace Skills;
use Players\Player;

/**
 * Interface Skill
 * @package Skills
 */
interface Skill
{
    /**
     * @param Player $player
     * @return mixed
     */
    public function apply(Player $player);
}
