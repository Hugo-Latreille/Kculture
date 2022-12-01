<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\ApiProperty;
use App\Entity\Trait\TimestampableEntity;
use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: QuestionRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ApiResource(
    paginationEnabled: false,
    normalizationContext: ['groups' => ['question:read']],
    // denormalizationContext:['groups' => ['question:write']]
)]

class Question
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['question:read'])]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['question:read', 'get:GameHasQuestions', 'answer:read', 'media:read'])]
    #[Assert\NotBlank]
    #[ApiProperty(types: ["https://schema.org/name"])]
    #[ApiFilter(SearchFilter::class, strategy: 'ipartial')]
    private ?string $question = null;

    #[ORM\Column]
    #[Groups(['question:read'])]
    #[Assert\NotBlank]
    private ?int $level = null;

    #[ORM\Column]
    #[Groups(['question:read'])]
    #[Assert\NotBlank]
    private ?int $timer = null;

    #[ORM\OneToMany(mappedBy: 'question', targetEntity: UserAnswer::class, orphanRemoval: true)]
    #[Groups(['question:read'])]
    private Collection $userAnswers;

    #[ORM\ManyToOne(inversedBy: 'questions')]
    #[Groups(['question:read'])]
    private ?Answer $answer = null;

    #[ORM\OneToMany(mappedBy: 'question', targetEntity: GameHasQuestions::class, orphanRemoval: true)]
    #[Groups(['question:read'])]
    private Collection $gameHasQuestions;

    #[ORM\OneToMany(mappedBy: 'question', targetEntity: Media::class)]
    #[ORM\JoinColumn(nullable: true)]
    #[ApiProperty(types: ['https://schema.org/MediaObject'])]
    #[Groups(['question:read'])]
    private Collection $media;
    // public ?Media $media = null;


    public function __construct()
    {
        $this->userAnswers = new ArrayCollection();
        $this->gameHasQuestions = new ArrayCollection();
        $this->media = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getTimer(): ?int
    {
        return $this->timer;
    }

    public function setTimer(int $timer): self
    {
        $this->timer = $timer;

        return $this;
    }

    public function getMedia(): ?Collection
    {
        return $this->media;
    }

    public function setMedia(?string $media): self
    {
        $this->media = $media;

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
            $userAnswer->setQuestion($this);
        }

        return $this;
    }

    public function removeUserAnswer(UserAnswer $userAnswer): self
    {
        if ($this->userAnswers->removeElement($userAnswer)) {
            // set the owning side to null (unless already changed)
            if ($userAnswer->getQuestion() === $this) {
                $userAnswer->setQuestion(null);
            }
        }

        return $this;
    }

    public function getAnswer(): ?Answer
    {
        return $this->answer;
    }

    public function setAnswer(?Answer $answer): self
    {
        $this->answer = $answer;

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
            $gameHasQuestion->setQuestion($this);
        }

        return $this;
    }

    public function removeGameHasQuestion(GameHasQuestions $gameHasQuestion): self
    {
        if ($this->gameHasQuestions->removeElement($gameHasQuestion)) {
            // set the owning side to null (unless already changed)
            if ($gameHasQuestion->getQuestion() === $this) {
                $gameHasQuestion->setQuestion(null);
            }
        }

        return $this;
    }

    public function addMedium(Media $medium): self
    {
        if (!$this->media->contains($medium)) {
            $this->media->add($medium);
            $medium->setQuestion($this);
        }

        return $this;
    }

    public function removeMedium(Media $medium): self
    {
        if ($this->media->removeElement($medium)) {
            // set the owning side to null (unless already changed)
            if ($medium->getQuestion() === $this) {
                $medium->setQuestion(null);
            }
        }

        return $this;
    }
}