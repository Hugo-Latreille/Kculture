<?php

namespace App\Controller;

use App\Entity\Question;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

#[AsController]
final class UploadFileController extends AbstractController
{
  public function __invoke(ManagerRegistry $doctrine, Request $request, int $id): Question
  {
    $uploadedFile = $request->files->get('question');
    if (!$uploadedFile) {
      throw new BadRequestHttpException('"file" is required');
    }

    $question = $doctrine->getRepository(Question::class)->find($id);


    $mediaObject = new Question();
    $mediaObject->setQuestion($question->getQuestion());
    $mediaObject->setTimer($question->getTimer());
    $mediaObject->setLevel($question->getLevel());

    $mediaObject->file = $uploadedFile;


    return $mediaObject;
  }
}