<?php

namespace App\State;

use App\Service\JWTService;
use ApiPlatform\Metadata\DeleteOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\User;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UserMailerProcessor implements ProcessorInterface
{

  public function __construct(private readonly ProcessorInterface $processor, private readonly UserPasswordHasherInterface $passwordHasher, private ProcessorInterface $removeProcessor, private readonly MailerInterface $mailer, JWTService $jwt)
  {
    $this->jwt = $jwt;
  }

  public function process($data, Operation $operation, array $uriVariables = [], array $context = [])
  {
    if ($operation instanceof DeleteOperationInterface) {
      return $this->removeProcessor->process($data, $operation, $uriVariables, $context);
    }

    if (!$data->getPlainPassword()) {
      return $this->processor->process($data, $operation, $uriVariables, $context);
    }

    $hashedPassword = $this->passwordHasher->hashPassword(
      $data,
      $data->getPlainPassword()
    );
    $data->setPassword($hashedPassword);
    $data->eraseCredentials();

    $this->sendWelcomeEmail($data);


    return $this->processor->process($data, $operation, $uriVariables, $context);
  }

  private function sendWelcomeEmail(User $user)
  {

    // On génère le JWT de l'utilisateur
    // On crée le Header
    $header = [
      'typ' => 'JWT',
      'alg' => 'HS256'
    ];

    // On crée le Payload
    $payload = [
      'user_email' => $user->getEmail()
    ];



    // On génère le token
    $token = $this->jwt->generate($header, $payload, '56465DSfsdsdfZEfze5489Asdkjroze');


    $email = (new TemplatedEmail())
      ->from('admin@quasiquiz.fr')
      ->to($user->getEmail())
      ->subject('QuasiQuiz : veuillez vérifier votre email')
      // ->html('<p>See Twig integration for better HTML integration!</p>');
      ->htmlTemplate('Email/verifEmail.twig')
      ->context([
        'username' => $user->getPseudo(),
        'token' => $token
      ]);


    $this->mailer->send($email);
  }
}