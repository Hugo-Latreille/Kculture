<?php

namespace App\Controller;

use App\Entity\Media;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

#[AsController]
final class UploadFileController extends AbstractController
{
  public function __invoke(Request $request): Media
  {
    // dd($request);
    $uploadedFile = $request->files->get('file');
    if (!$uploadedFile) {
      throw new BadRequestHttpException('"file" is required');
    }

    $mediaObject = new Media();
    $mediaObject->file = $uploadedFile;


    return $mediaObject;
  }
}