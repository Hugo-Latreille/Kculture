<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\GameHasQuestions;
use App\Entity\Question;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameQuestionsController extends AbstractController
{
    #[Route('/game/{GameId<\d+>}/questions/{nbrOfQuestions<\d+>}', name: 'app_game_questions')]
    public function test(ManagerRegistry $doctrine, int $GameId, int $nbrOfQuestions = 3): Response
    {
        $entityManager = $doctrine->getManager();
        $game = $doctrine->getRepository(Game::class)->find($GameId);
        if (!$game) {
            return $this->json("La partie demandée n'existe pas", 400);
        }

        $questions = $doctrine->getRepository(Question::class)->findAll();

        $questionsIdsArray = [];

        foreach ($questions as $question) {
            $questionId = $question->getId();
            array_push($questionsIdsArray, $questionId);
        }

        // dd($questionsIdsArray);
        shuffle($questionsIdsArray);
        // dd($questionsIdsArray);
        $questionsIdsArray = array_slice($questionsIdsArray, 0, $nbrOfQuestions);


        //? Pour chaque id du tableau, faire persister en bdd

        foreach ($questionsIdsArray as $randomQuestionId) {
            $randomQuestion = $doctrine->getRepository(Question::class)->find($randomQuestionId);
            // dump($randomQuestionId);
            // dump($randomQuestion);

            $gameQuestion = new GameHasQuestions();
            $gameQuestion->setGame($game);
            $gameQuestion->setQuestion($randomQuestion);
            $entityManager->persist($gameQuestion);
            // dump($gameQuestion);
        }
        $entityManager->flush();


        return $this->json("Les questions ont été générées", 200);
    }
}