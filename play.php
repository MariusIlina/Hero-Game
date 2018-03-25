<?php

require_once __DIR__ . '/vendor/autoload.php';

use Game\Game;
use Game\Output;
use Players\Hero;
use Players\Monster;

// Who's the first attacker/defender? Arguments order is not relevant.
$roles = Game::getInitialRoles(new Hero, new Monster);
$attacker = $roles['attacker'];
$defender = $roles['defender'];

// Start fight
Output::explainInitialRoles($attacker, $defender);
Game::play($attacker, $defender);
