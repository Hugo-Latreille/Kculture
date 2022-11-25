<?php

namespace App\Controller;

use App\Entity\Question;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameQuestionsController extends AbstractController
{
    #[Route('/game/{id}/questions', name: 'app_game_questions')]
    public function test(int $id, ManagerRegistry $doctrine): Response
    {

        $questions = $doctrine->getRepository(Question::class)->findAll();

        $questionsArray = [];
        foreach ($questions as $question) {
            $questionId = $question->getId();
            array_push($questionsArray, $questionId);
        }

        $randomQuestions = array_rand($questionsArray, 5);
        shuffle($randomQuestions);


        //? Pour chaque id du tableau, faire persister en bdd
        // https://symfony.com/doc/current/doctrine.html#fetching-objects-from-the-database

        // dd($randomQuestions);
        dd($id);
    }
}