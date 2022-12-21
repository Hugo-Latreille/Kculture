<?php

namespace App\DataFixtures;

use App\Entity\Answer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class AnswerFixtures extends Fixture
{

  public const ANSWER1_REFERENCE = "reponse1";
  public const ANSWER2_REFERENCE = "reponse2";
  public const ANSWER3_REFERENCE = "reponse3";
  public const ANSWER4_REFERENCE = "reponse4";
  public const ANSWER5_REFERENCE = "reponse5";
  public const ANSWER6_REFERENCE = "reponse6";
  public const ANSWER7_REFERENCE = "reponse7";
  public const ANSWER8_REFERENCE = "reponse8";
  public const ANSWER9_REFERENCE = "reponse9";
  public const ANSWER10_REFERENCE = "reponse10";

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

    $answer3 = new Answer();
    $answer3->setAnswer("error system");
    $manager->persist($answer3);
    $this->addReference(self::ANSWER3_REFERENCE, $answer3);

    $answer4 = new Answer();
    $answer4->setAnswer("error system");
    $manager->persist($answer4);
    $this->addReference(self::ANSWER4_REFERENCE, $answer4);

    $answer5 = new Answer();
    $answer5->setAnswer("error system");
    $manager->persist($answer5);
    $this->addReference(self::ANSWER5_REFERENCE, $answer5);

    $answer6 = new Answer();
    $answer6->setAnswer("error system");
    $manager->persist($answer6);
    $this->addReference(self::ANSWER6_REFERENCE, $answer6);

    $answer7 = new Answer();
    $answer7->setAnswer("error system");
    $manager->persist($answer7);
    $this->addReference(self::ANSWER7_REFERENCE, $answer7);

    $answer8 = new Answer();
    $answer8->setAnswer("error system");
    $manager->persist($answer8);
    $this->addReference(self::ANSWER8_REFERENCE, $answer8);

    $answer9 = new Answer();
    $answer9->setAnswer("error system");
    $manager->persist($answer9);
    $this->addReference(self::ANSWER9_REFERENCE, $answer9);

    $answer10 = new Answer();
    $answer10->setAnswer("error system");
    $manager->persist($answer10);
    $this->addReference(self::ANSWER10_REFERENCE, $answer10);

    $manager->flush();
  }
}