# Hero-Game

<h3>Installation:</h3>
PHP 7.0 is required.
<h5>Clone the project</h5>

```bash
git clone https://github.com/MariusIlina/Hero-Game.git
```

```bash
cd ./Hero-Game/
```

<h5>Install PHPUnit and insure auto-loading</h5>

```bash
composer install
```

<h5>Run tests (I covered some very basic testing, but there are complex flows that remain untested, like the occurrence of a skill and others)</h5>

```bash
./vendor/bin/phpunit
```

<h5>Run game</h5>

```bash
php play.php
```

<h3>Game-flow observations:</h3>

1. **Luck** is treated as a skill, because it shares some common behaviour with **Magic Shield** and **Rapid Strike**.
2. Any skill occurrence is limited to the maximum favorable cases, but is not necessary that they all occur. For example:
    <br>- if maximum turns is 20, then the maximum hits I can take is 10;
    <br>- Let's say Magic Shield has a probability of 30%;
    <br>- Maximum favorable cases is 3, calculated as (10*30)/100
    <br>- Then I can use Magic Shield for 3 times out of 10, but this does not mean I will use them all. It only means I cannot use more than 3.
    
    The reason I did this is because if all favorable cases were mandatory to be used, then all the skill occurrences would pile-up at the beginning of the game and this would eliminate any randomness. I'm sure there are other solutions, but this is what I came up with.
   
3. Skills can occur immediately one after another. For example, if Monster hits Orderus, then Orderus can first use Magic Shield then use Luck one after another (FOR THE SAME HIT TAKEN). Of course, this makes Magic Shield useless, cause Luck brings the damage to 0. But it can happen.

<h3>Code-related notes:</h3>

1. New players can be added by creating a new class that implements the Player interface.

2. New skills can be added by acquiring a Skill object in the constructor of a Player class and defining a behaviour for that Skill inside the Player class.

3. Objects of Skill class are only used to determine whether a skill occurs or not, based on how many times it occurred and some randomness. What happens if the skill occurred is decided inside the Player instance. 

4. I think skills could've been distinct classes implementing an interface, but for this example, that would add complexity.

