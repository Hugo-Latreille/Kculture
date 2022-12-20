<?php

namespace App\State;

use ApiPlatform\Metadata\DeleteOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\User;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UserMailerProcessor implements ProcessorInterface
{
  public function __construct(private readonly ProcessorInterface $processor, private readonly UserPasswordHasherInterface $passwordHasher, private ProcessorInterface $removeProcessor, private readonly MailerInterface $mailer)
  {
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

    $email = (new Email())
      ->from('quasiquiz@gmail.com')
      ->to('huneo@hotmail.com')
      ->subject('QuasiQuiz : veuillez vérifier votre email')
      ->text('Sending emails is fun again!')
      ->html('<p>See Twig integration for better HTML integration!</p>');


    $this->mailer->send($email);
  }
}