<?php

include_once 'autoload.php';

use Players\Hero;
use Players\Monster;

// Who's the first attacker/defender?
$first = Game::getInitialRoles(new Hero, new Monster);

// Explain first roles
Game::explainInitialRoles($first['attacker'], $first['defender']);

// Start fight
Game::play($first['attacker'], $first['defender']);
