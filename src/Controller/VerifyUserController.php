<?php

namespace App\Controller;


use App\Repository\UserRepository;
use App\Service\JWTService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;


class VerifyUserController extends AbstractController
{


  #[Route('/verif/{token}', name: 'verify_user')]
  public function verifyUser($token, JWTService $jwt, UserRepository $userRepository, EntityManagerInterface $em): Response
  {

    //On vérifie si le token est valide, n'a pas expiré et n'a pas été modifié
    if ($jwt->isValid($token) && !$jwt->isExpired($token) && $jwt->check($token, '56465DSfsdsdfZEfze5489Asdkjroze')) {
      // On récupère le payload
      $payload = $jwt->getPayload($token);

      // On récupère le user du token
      $user = $userRepository->findOneBy(['email' => $payload['user_email']]);

      //On vérifie que l'utilisateur existe et n'a pas encore activé son compte
      if ($user && !$user->isIsVerified()) {
        $user->setIsVerified(true);
        $em->flush($user);
        return new RedirectResponse('https://www.quasiquiz.net/login');
      }
    }
    // Ici un problème se pose dans le token
    return $this->json("Le lien n'est pas valide", 401);
  }
}