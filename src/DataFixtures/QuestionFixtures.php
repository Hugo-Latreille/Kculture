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
  public const QUESTION3_REFERENCE = "question3";
  public const QUESTION4_REFERENCE = "question4";
  public const QUESTION5_REFERENCE = "question5";
  public const QUESTION6_REFERENCE = "question6";
  public const QUESTION7_REFERENCE = "question7";
  public const QUESTION8_REFERENCE = "question8";
  public const QUESTION9_REFERENCE = "question9";
  public const QUESTION10_REFERENCE = "question10";

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

    $question3 = new Question();
    $question3->setQuestion("Pourquoi les babouches ?");
    $question3->setAnswer($this->getReference(AnswerFixtures::ANSWER3_REFERENCE));
    $question3->setLevel(2);
    $question3->setTimer(45);
    $manager->persist($question3);
    $this->addReference(self::QUESTION3_REFERENCE, $question3);

    $question4 = new Question();
    $question4->setQuestion("Pourquoi les babouches ?");
    $question4->setAnswer($this->getReference(AnswerFixtures::ANSWER4_REFERENCE));
    $question4->setLevel(2);
    $question4->setTimer(45);
    $manager->persist($question4);
    $this->addReference(self::QUESTION4_REFERENCE, $question4);

    $question5 = new Question();
    $question5->setQuestion("Pourquoi les babouches ?");
    $question5->setAnswer($this->getReference(AnswerFixtures::ANSWER5_REFERENCE));
    $question5->setLevel(5);
    $question5->setTimer(45);
    $manager->persist($question5);
    $this->addReference(self::QUESTION5_REFERENCE, $question5);

    $question6 = new Question();
    $question6->setQuestion("Pourquoi les babouches ?");
    $question6->setAnswer($this->getReference(AnswerFixtures::ANSWER6_REFERENCE));
    $question6->setLevel(6);
    $question6->setTimer(45);
    $manager->persist($question6);
    $this->addReference(self::QUESTION6_REFERENCE, $question6);

    $question7 = new Question();
    $question7->setQuestion("Pourquoi les babouches ?");
    $question7->setAnswer($this->getReference(AnswerFixtures::ANSWER7_REFERENCE));
    $question7->setLevel(7);
    $question7->setTimer(45);
    $manager->persist($question7);
    $this->addReference(self::QUESTION7_REFERENCE, $question7);

    $question8 = new Question();
    $question8->setQuestion("Pourquoi les babouches ?");
    $question8->setAnswer($this->getReference(AnswerFixtures::ANSWER8_REFERENCE));
    $question8->setLevel(8);
    $question8->setTimer(45);
    $manager->persist($question8);
    $this->addReference(self::QUESTION8_REFERENCE, $question8);

    $question9 = new Question();
    $question9->setQuestion("Pourquoi les babouches ?");
    $question9->setAnswer($this->getReference(AnswerFixtures::ANSWER9_REFERENCE));
    $question9->setLevel(9);
    $question9->setTimer(45);
    $manager->persist($question9);
    $this->addReference(self::QUESTION9_REFERENCE, $question9);

    $question10 = new Question();
    $question10->setQuestion("Pourquoi les babouches ?");
    $question10->setAnswer($this->getReference(AnswerFixtures::ANSWER10_REFERENCE));
    $question10->setLevel(10);
    $question10->setTimer(45);
    $manager->persist($question10);
    $this->addReference(self::QUESTION10_REFERENCE, $question10);

    $manager->flush();
  }

  public function getDependencies()
  {
    return [
      AnswerFixtures::class
    ];
  }
}