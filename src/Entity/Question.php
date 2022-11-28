<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Entity\Trait\TimestampableEntity;
use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @Vich\Uploadable
 */
#[ORM\Entity(repositoryClass: QuestionRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ApiResource(
    paginationEnabled: false,
    operations: [
        new GetCollection(),
        new Post(inputFormats: ['multipart' => ['multipart/form-data']])
    ]
)]

class Question
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $question = null;

    #[ORM\Column]
    private ?int $level = null;

    #[ORM\Column]
    private ?int $timer = null;

    //******* CONFIG UPLOAD
    #[ApiProperty(types: ['https://schema.org/contentUrl'])]
    // #[Groups(['book:read'])]
    public ?string $contentUrl = null;

    /**
     * @Vich\UploadableField(mapping="media_object", fileNameProperty="filePath")
     */
    // #[Groups(['book:write'])]
    public ?File $file = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $media = null;

    //******* 

    #[ORM\OneToMany(mappedBy: 'question', targetEntity: UserAnswer::class, orphanRemoval: true)]
    private Collection $userAnswers;

    #[ORM\ManyToOne(inversedBy: 'questions')]
    private ?Answer $answer = null;

    #[ORM\OneToMany(mappedBy: 'question', targetEntity: GameHasQuestions::class, orphanRemoval: true)]
    private Collection $gameHasQuestions;


    public function __construct()
    {
        $this->userAnswers = new ArrayCollection();
        $this->gameHasQuestions = new ArrayCollection();
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

    public function getMedia(): ?string
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
}