<?php

namespace App\DataFixtures;

use App\Entity\Score;
use App\DataFixtures\UsersFixtures;
use App\DataFixtures\GamesFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class ScoreFixtures extends Fixture implements DependentFixtureInterface
{

  public function load(ObjectManager $manager): void
  {
    $score1 = new Score();
    $score1->setScore(56);
    $score1->setUserId($this->getReference(UsersFixtures::USER_REFERENCE));
    $score1->setGame($this->getReference(GamesFixtures::GAME_REFERENCE));
    $manager->persist($score1);


    $score2 = new Score();
    $score2->setScore(42);
    $score2->setUserId($this->getReference(UsersFixtures::USER2_REFERENCE));
    $score2->setGame($this->getReference(GamesFixtures::GAME2_REFERENCE));
    $manager->persist($score2);




    $manager->flush();
  }

  public function getDependencies()
  {
    return [
      UsersFixtures::class,
      GamesFixtures::class
    ];
  }
}