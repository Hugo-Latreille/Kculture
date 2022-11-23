<?php

namespace App\DataFixtures;

use App\Entity\Question;
use App\DataFixtures\AnswerFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class QuestionFixtures extends Fixture implements DependentFixtureInterface
{

  public const QUESTION1_REFERENCE = "question1";
  public const QUESTION2_REFERENCE = "question2";

  public function load(ObjectManager $manager): void
  {
    $question1 = new Question();
    $question1->setQuestion("Quel est le nombre ?");
    $question1->setAnswer($this->getReference(AnswerFixtures::ANSWER1_REFERENCE));
    $question1->setMedia("/image54931351.png");
    $question1->setLevel(1);
    $question1->setTimer(30);
    $manager->persist($question1);
    $this->addReference(self::QUESTION1_REFERENCE, $question1);

    $question2 = new Question();
    $question2->setQuestion("Pourquoi les babouches ?");
    $question2->setAnswer($this->getReference(AnswerFixtures::ANSWER2_REFERENCE));
    $question2->setLevel(2);
    $question2->setTimer(45);
    $manager->persist($question2);
    $this->addReference(self::QUESTION2_REFERENCE, $question2);

    $manager->flush();
  }

  public function getDependencies()
  {
    return [
      AnswerFixtures::class
    ];
  }
}