<?php

require_once __DIR__ . '/vendor/autoload.php';

use Game\Game;
use Players\Hero;
use Players\Monster;

// Who's the first attacker/defender? Arguments order is not relevant.
$first = Game::getInitialRoles(new Hero, new Monster);

// Explain first roles
Game::explainInitialRoles($first['attacker'], $first['defender']);

// Start fight
Game::play($first['attacker'], $first['defender']);
