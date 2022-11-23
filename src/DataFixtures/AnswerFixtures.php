<?php

namespace App\DataFixtures;

use App\Entity\Answer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class AnswerFixtures extends Fixture
{

  public const ANSWER1_REFERENCE = "reponse1";
  public const ANSWER2_REFERENCE = "reponse2";

  public function load(ObjectManager $manager): void
  {
    $answer1 = new Answer();
    $answer1->setAnswer("42");
    $manager->persist($answer1);
    $this->addReference(self::ANSWER1_REFERENCE, $answer1);

    $answer2 = new Answer();
    $answer2->setAnswer("error system");
    $manager->persist($answer2);
    $this->addReference(self::ANSWER2_REFERENCE, $answer2);

    $manager->flush();
  }
}