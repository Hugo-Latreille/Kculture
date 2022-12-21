<?php

namespace App\DataFixtures;

use App\Entity\Message;
use App\DataFixtures\GamesFixtures;
use App\DataFixtures\UsersFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class MessageFixtures extends Fixture implements DependentFixtureInterface
{

  public function load(ObjectManager $manager): void
  {
    $message1 = new Message();
    $message1->setMessage("Kikou, asv ?");
    $message1->setUserId($this->getReference(UsersFixtures::USER_REFERENCE));
    $message1->setGame($this->getReference(GamesFixtures::GAME_REFERENCE));
    $manager->persist($message1);


    $message2 = new Message();
    $message2->setMessage("Francis du 23, 62 ans");
    $message2->setUserId($this->getReference(UsersFixtures::USER2_REFERENCE));
    $message2->setGame($this->getReference(GamesFixtures::GAME_REFERENCE));
    $manager->persist($message2);


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