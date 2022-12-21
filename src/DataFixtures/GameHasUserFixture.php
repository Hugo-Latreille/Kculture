<?php

namespace App\DataFixtures;


use App\Entity\GameHasUser;
use App\DataFixtures\GamesFixtures;
use App\DataFixtures\UsersFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class GameHasUserFixture extends Fixture implements DependentFixtureInterface
{

  public function load(ObjectManager $manager): void
  {
    $user1inGame1 = new GameHasUser();
    $user1inGame1->setIsGameMaster(true);
    $user1inGame1->setUserId($this->getReference(UsersFixtures::USER_REFERENCE));
    $user1inGame1->setGame($this->getReference(GamesFixtures::GAME_REFERENCE));
    $manager->persist($user1inGame1);

    $user2inGame1 = new GameHasUser();
    $user2inGame1->setIsGameMaster(false);
    $user2inGame1->setUserId($this->getReference(UsersFixtures::USER2_REFERENCE));
    $user2inGame1->setGame($this->getReference(GamesFixtures::GAME_REFERENCE));
    $manager->persist($user2inGame1);


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