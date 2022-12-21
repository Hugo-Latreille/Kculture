<?php

namespace App\DataFixtures;


use App\DataFixtures\GamesFixtures;
use App\DataFixtures\QuestionFixtures;
use App\Entity\GameHasQuestions;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class GameHasQuestionsFixtures extends Fixture implements DependentFixtureInterface
{

  public function load(ObjectManager $manager): void
  {

    $game1hasQuestion1 = new GameHasQuestions();
    $game1hasQuestion1->setGame($this->getReference(GamesFixtures::GAME_REFERENCE));
    $game1hasQuestion1->setQuestion($this->getReference(QuestionFixtures::QUESTION1_REFERENCE));
    $manager->persist($game1hasQuestion1);


    $game1hasQuestion2 = new GameHasQuestions();
    $game1hasQuestion2->setGame($this->getReference(GamesFixtures::GAME_REFERENCE));
    $game1hasQuestion2->setQuestion($this->getReference(QuestionFixtures::QUESTION2_REFERENCE));
    $manager->persist($game1hasQuestion2);

    $manager->flush();
  }

  public function getDependencies()
  {
    return [
      QuestionFixtures::class,
      GamesFixtures::class
    ];
  }
}