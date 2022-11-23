<?php

namespace App\DataFixtures;

// use App\DataFixtures\AnswerFixtures;

use App\Entity\UserAnswer;
use App\DataFixtures\GamesFixtures;
use App\DataFixtures\UsersFixtures;
use App\DataFixtures\QuestionFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class UserAnswerFixtures extends Fixture implements DependentFixtureInterface
{

  public function load(ObjectManager $manager): void
  {
    $userAnswer1 = new UserAnswer();
    $userAnswer1->setAnswer("666");
    $userAnswer1->setGame($this->getReference(GamesFixtures::GAME_REFERENCE));
    $userAnswer1->setQuestion($this->getReference(QuestionFixtures::QUESTION1_REFERENCE));
    $userAnswer1->setUserId($this->getReference(UsersFixtures::USER_REFERENCE));
    $manager->persist($userAnswer1);


    $userAnswer2 = new UserAnswer();
    $userAnswer2->setAnswer("sjkbnzeifjnze");
    $userAnswer2->setGame($this->getReference(GamesFixtures::GAME_REFERENCE));
    $userAnswer2->setQuestion($this->getReference(QuestionFixtures::QUESTION1_REFERENCE));
    $userAnswer2->setUserId($this->getReference(UsersFixtures::USER2_REFERENCE));
    $manager->persist($userAnswer2);



    $manager->flush();
  }

  public function getDependencies()
  {
    return [
      AnswerFixtures::class
    ];
  }
}