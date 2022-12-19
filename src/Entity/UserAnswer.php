<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\Trait\TimestampableEntity;
use App\Repository\UserAnswerRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UserAnswerRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ApiResource(
    mercure: true,
    paginationEnabled: false,
    normalizationContext: ['groups' => ['get:userAnswers']]
)]
#[ApiFilter(SearchFilter::class, properties: ['userId' => 'exact', 'question' => 'exact', 'game' => 'exact'])]
//? Route filtrée : https://localhost:8000/api/user_answers?userId=25&question=44&game=11

class UserAnswer
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['get:userAnswers'])]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['question:read', 'get:userAnswers'])]
    private ?string $answer = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['get:userAnswers'])]
    private ?bool $is_true = null;

    #[ORM\ManyToOne(inversedBy: 'userAnswers')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['question:read', 'get:userAnswers'])]
    private ?User $userId = null;

    #[ORM\ManyToOne(inversedBy: 'userAnswers')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['question:read'])]
    private ?Question $question = null;

    #[ORM\ManyToOne(inversedBy: 'userAnswers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Game $game = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnswer(): ?string
    {
        return $this->answer;
    }

    public function setAnswer(string $answer): self
    {
        $this->answer = $answer;

        return $this;
    }

    public function isIsTrue(): ?bool
    {
        return $this->is_true;
    }

    public function setIsTrue(?bool $is_true): self
    {
        $this->is_true = $is_true;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(?User $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): self
    {
        $this->game = $game;

        return $this;
    }
}