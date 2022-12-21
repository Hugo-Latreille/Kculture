<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Link;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\Trait\TimestampableEntity;
use App\Repository\GameHasUserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: GameHasUserRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ApiResource(
    mercure: true,
    paginationEnabled: false,
    normalizationContext: ['groups' => ['get:GameHasUsers']],
)]

#[ApiFilter(SearchFilter::class, properties: ['game' => 'exact', 'userId' => 'exact'])]
//? Route filtrée : https://localhost:8000/api/game_has_users?game=



class GameHasUser
{
    use TimestampableEntity;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['get:Games', 'get:GameHasUsers', 'get:GameHasQuestions'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['get:Games', 'get:GameHasUsers', 'get:GameHasQuestions', 'get:Messages'])]
    private ?bool $is_game_master = null;

    #[ORM\ManyToOne(inversedBy: 'game')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['get:Games', 'get:GameHasUsers', 'get:GameHasQuestions', 'get:Messages'])]
    private ?User $userId = null;

    #[ORM\ManyToOne(inversedBy: 'gameHasUsers')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['get:Games', 'get:GameHasUsers'])]
    private ?Game $game = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isIsGameMaster(): ?bool
    {
        return $this->is_game_master;
    }

    public function setIsGameMaster(bool $is_game_master): self
    {
        $this->is_game_master = $is_game_master;

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