<?php

declare(strict_types = 1);

use Players\Skill;
use PHPUnit\Framework\TestCase;

/**
 * Class SkillTest
 */
final class SkillTest extends TestCase
{
    /**
     * @var \Players\Skill $skill
     */
    private $skill;

    /**
     * Run before each tests
     */
    public function setUp()
    {
        $this->skill = new Skill('Magic Shield', 20, 10);
        parent::setUp();
    }

    /**
     * Confirm that getProbability() returns what it is supposed to.
     */
    public function test_get_probability()
    {
        $this->assertEquals('integer', gettype($this->skill->getProbability()));
        $this->assertEquals(20, $this->skill->getProbability());
    }

    /**
     * Confirm that getName() returns what it is supposed to.
     */
    public function test_get_name()
    {
        $this->assertEquals('string', gettype($this->skill->getName()));
        $this->assertEquals('Magic Shield', $this->skill->getName());
    }

    /**
     * Confirm that getFavorableCases() returns what it is supposed to.
     * For a total of 10 cases and a 20% probability, it should return 2.
     */
    public function test_get_favorable_cases()
    {
        $this->assertEquals('integer', gettype($this->skill->getFavorableCases()));
        $this->assertEquals(2, $this->skill->getFavorableCases());
    }

    /**
     * Confirm that apply() returns what it is supposed to.
     */
    public function test_apply_skill()
    {
        // Either true or false, this should always be boolean.
        $this->assertEquals('boolean', gettype($this->skill->apply()));

        // When timesUsed == favorableCases, it should return false.
        $this->skill->timesUsed = $this->skill->getFavorableCases();
        $this->assertFalse($this->skill->apply());
    }
}
