<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use App\Entity\Trait\TimestampableEntity;
use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: GameRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ApiResource(
    paginationEnabled: false,
    normalizationContext: ['groups' => ['get:Games']]
)]

#[ApiFilter(BooleanFilter::class, properties: ['is_open'])]
//? Route filtrée : https://localhost:8000/api/games?is_open=true

class Game
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['get:Games', 'get:GameHasQuestions', 'get:GameHasUsers'])]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'game', targetEntity: Message::class, orphanRemoval: true)]
    #[Groups('get:Games')]
    private Collection $messages;

    #[ORM\OneToMany(mappedBy: 'game', targetEntity: Score::class, orphanRemoval: true)]
    #[Groups('get:Games')]
    private Collection $scores;

    #[ORM\OneToMany(mappedBy: 'game', targetEntity: UserAnswer::class, orphanRemoval: true)]
    #[Groups('get:Games')]
    private Collection $userAnswers;

    #[ORM\OneToMany(mappedBy: 'game', targetEntity: GameHasUser::class)]
    #[Groups('get:Games')]
    private Collection $gameHasUsers;

    #[ORM\OneToMany(mappedBy: 'game', targetEntity: GameHasQuestions::class, orphanRemoval: true)]
    #[Groups('get:Games')]
    private Collection $gameHasQuestions;

    #[ORM\Column(nullable: true)]
    #[Groups('get:Games')]
    private ?bool $is_open = true;

    #[ORM\Column(nullable: true)]
    #[Groups('get:Games')]
    private ?bool $is_corrected = false;


    public function __construct()
    {
        $this->messages = new ArrayCollection();
        $this->scores = new ArrayCollection();
        $this->userAnswers = new ArrayCollection();
        $this->gameHasUsers = new ArrayCollection();
        $this->gameHasQuestions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @return Collection<int, Message>
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages->add($message);
            $message->setGame($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getGame() === $this) {
                $message->setGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Score>
     */
    public function getScores(): Collection
    {
        return $this->scores;
    }

    public function addScore(Score $score): self
    {
        if (!$this->scores->contains($score)) {
            $this->scores->add($score);
            $score->setGame($this);
        }

        return $this;
    }

    public function removeScore(Score $score): self
    {
        if ($this->scores->removeElement($score)) {
            // set the owning side to null (unless already changed)
            if ($score->getGame() === $this) {
                $score->setGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UserAnswer>
     */
    public function getUserAnswers(): Collection
    {
        return $this->userAnswers;
    }

    public function addUserAnswer(UserAnswer $userAnswer): self
    {
        if (!$this->userAnswers->contains($userAnswer)) {
            $this->userAnswers->add($userAnswer);
            $userAnswer->setGame($this);
        }

        return $this;
    }

    public function removeUserAnswer(UserAnswer $userAnswer): self
    {
        if ($this->userAnswers->removeElement($userAnswer)) {
            // set the owning side to null (unless already changed)
            if ($userAnswer->getGame() === $this) {
                $userAnswer->setGame(null);
            }
        }

        return $this;
    }



    /**
     * @return Collection<int, GameHasUser>
     */
    public function getGameHasUsers(): Collection
    {
        return $this->gameHasUsers;
    }

    public function addGameHasUser(GameHasUser $gameHasUser): self
    {
        if (!$this->gameHasUsers->contains($gameHasUser)) {
            $this->gameHasUsers->add($gameHasUser);
            $gameHasUser->setGame($this);
        }

        return $this;
    }

    public function removeGameHasUser(GameHasUser $gameHasUser): self
    {
        if ($this->gameHasUsers->removeElement($gameHasUser)) {
            // set the owning side to null (unless already changed)
            if ($gameHasUser->getGame() === $this) {
                $gameHasUser->setGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, GameHasQuestions>
     */
    public function getGameHasQuestions(): Collection
    {
        return $this->gameHasQuestions;
    }

    public function addGameHasQuestion(GameHasQuestions $gameHasQuestion): self
    {
        if (!$this->gameHasQuestions->contains($gameHasQuestion)) {
            $this->gameHasQuestions->add($gameHasQuestion);
            $gameHasQuestion->setGame($this);
        }

        return $this;
    }

    public function removeGameHasQuestion(GameHasQuestions $gameHasQuestion): self
    {
        if ($this->gameHasQuestions->removeElement($gameHasQuestion)) {
            // set the owning side to null (unless already changed)
            if ($gameHasQuestion->getGame() === $this) {
                $gameHasQuestion->setGame(null);
            }
        }

        return $this;
    }

    public function isIsOpen(): ?bool
    {
        return $this->is_open;
    }

    public function setIsOpen(?bool $is_open): self
    {
        $this->is_open = $is_open;

        return $this;
    }

    public function isIsCorrected(): ?bool
    {
        return $this->is_corrected;
    }

    public function setIsCorrected(?bool $is_corrected): self
    {
        $this->is_corrected = $is_corrected;

        return $this;
    }
}