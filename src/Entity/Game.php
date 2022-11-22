<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $game_number = null;

    #[ORM\OneToMany(mappedBy: 'game', targetEntity: Message::class, orphanRemoval: true)]
    private Collection $messages;

    #[ORM\OneToMany(mappedBy: 'game', targetEntity: Score::class, orphanRemoval: true)]
    private Collection $scores;

    #[ORM\OneToMany(mappedBy: 'game', targetEntity: UserAnswer::class, orphanRemoval: true)]
    private Collection $userAnswers;

    #[ORM\OneToMany(mappedBy: 'game', targetEntity: GameHasUser::class)]
    private Collection $gameHasUsers;

    #[ORM\OneToMany(mappedBy: 'game', targetEntity: GameHasQuestions::class, orphanRemoval: true)]
    private Collection $gameHasQuestions;

    #[ORM\Column(type: Types::DATETIMETZ_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column(type: Types::DATETIMETZ_MUTABLE)]
    private ?\DateTimeInterface $updated_at = null;

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

    public function getGameNumber(): ?int
    {
        return $this->game_number;
    }

    public function setGameNumber(int $game_number): self
    {
        $this->game_number = $game_number;

        return $this;
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
