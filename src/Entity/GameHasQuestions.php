<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Entity\Trait\TimestampableEntity;
use App\Repository\GameHasQuestionsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: GameHasQuestionsRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ApiResource(
    paginationEnabled: false,
    normalizationContext: ['groups' => ['get:GameHasQuestions']]
)]
#[ApiFilter(SearchFilter::class, properties: ['game' => 'exact'])]

class GameHasQuestions
{

    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'gameHasQuestions')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups('get:GameHasQuestions')]
    private ?Game $game = null;

    #[ORM\ManyToOne(inversedBy: 'gameHasQuestions')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups('get:GameHasQuestions')]
    private ?Question $question = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): self
    {
        $this->question = $question;

        return $this;
    }
}