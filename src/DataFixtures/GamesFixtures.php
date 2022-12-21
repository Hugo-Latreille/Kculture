<?php

namespace App\DataFixtures;

use App\Entity\Game;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;



class GamesFixtures extends Fixture
{

  public const GAME_REFERENCE = 'game1';
  public const GAME2_REFERENCE = 'game2';

  public function load(ObjectManager $manager): void
  {
    $game1 = new Game();
    $manager->persist($game1);

    $this->addReference(self::GAME_REFERENCE, $game1);

    $game2 = new Game();
    $manager->persist($game2);

    $this->addReference(self::GAME2_REFERENCE, $game2);


    $manager->flush();
  }
}