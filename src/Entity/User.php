<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Patch;
use App\Entity\Trait\TimestampableEntity;
use App\Repository\UserRepository;
use App\State\UserPasswordHasherProcessor;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\HasLifecycleCallbacks]
#[
    ApiResource(
        paginationEnabled: false,
        normalizationContext: ['groups' => ['get:Users']],
        denormalizationContext: ['groups' => ['post:User']],
        processor: UserPasswordHasherProcessor::class
    )
]
//? TEST SECURITE : on accorde l'accès à l'admin/à l'utilisateur actuellement connecté uniquement pour son compte
// #[GetCollection(security: "is_granted('ROLE_ADMIN')", securityMessage: 'Seuls les ADMINS peuvent accéder à cette ressource')]
// #[Get(security: "is_granted('ROLE_ADMIN') or object == user", securityMessage: 'Seuls les ADMINS peuvent accéder à cette ressource')]
// #[Post]
// #[Delete(security: "is_granted('ROLE_ADMIN') or object == user", securityMessage: 'Seuls les ADMINS peuvent accéder à cette ressource')]
// #[Patch(security: "is_granted('ROLE_ADMIN') or object == user", securityMessage: 'Seuls les ADMINS peuvent accéder à cette ressource')]
// #[Put(security: "is_granted('ROLE_ADMIN') or object == user", securityMessage: 'Seuls les ADMINS peuvent accéder à cette ressource')]




class User implements UserInterface, PasswordAuthenticatedUserInterface
{

    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('get:Users')]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true, nullable: false)]
    #[Groups(['get:Users', 'post:User'])]
    #[Assert\Email(
        message: 'L\'email {{ value }} n\'est pas valide.',
    )]
    private ?string $email = null;

    #[ORM\Column]
    #[Groups(['get:Users', 'post:User'])]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column(nullable: false)]
    #[Groups(['get:Users', 'post:User'])]
    #[Assert\NotBlank]
    private ?string $password = null;

    #[ORM\Column(length: 20, nullable: false)]
    #[Groups(['get:Users', 'post:User'])]
    private ?string $pseudo = null;

    #[ORM\Column]
    private ?bool $is_ready = false;

    #[ORM\OneToMany(mappedBy: 'userId', targetEntity: Message::class, orphanRemoval: true)]
    #[Groups('get:Users')]
    private Collection $message;

    #[ORM\OneToMany(mappedBy: 'userId', targetEntity: Score::class, orphanRemoval: true)]
    #[Groups('get:Users')]
    private Collection $scores;

    #[ORM\OneToMany(mappedBy: 'userId', targetEntity: UserAnswer::class, orphanRemoval: true)]
    #[Groups('get:Users')]
    private Collection $userAnswers;

    #[ORM\OneToMany(mappedBy: 'userId', targetEntity: GameHasUser::class)]
    #[Groups('get:Users')]
    private Collection $game;

    public function __construct()
    {
        $this->message = new ArrayCollection();
        $this->scores = new ArrayCollection();
        $this->userAnswers = new ArrayCollection();
        $this->game = new ArrayCollection();
    }/* a tester */

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function isIsReady(): ?bool
    {
        return $this->is_ready;
    }

    public function setIsReady(bool $is_ready): self
    {
        $this->is_ready = $is_ready;

        return $this;
    }


    /**
     * @return Collection<int, Message>
     */
    public function getMessage(): Collection
    {
        return $this->message;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->message->contains($message)) {
            $this->message->add($message);
            $message->setUserId($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->message->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getUserId() === $this) {
                $message->setUserId(null);
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
            $score->setUserId($this);
        }

        return $this;
    }

    public function removeScore(Score $score): self
    {
        if ($this->scores->removeElement($score)) {
            // set the owning side to null (unless already changed)
            if ($score->getUserId() === $this) {
                $score->setUserId(null);
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
            $userAnswer->setUserId($this);
        }

        return $this;
    }

    public function removeUserAnswer(UserAnswer $userAnswer): self
    {
        if ($this->userAnswers->removeElement($userAnswer)) {
            // set the owning side to null (unless already changed)
            if ($userAnswer->getUserId() === $this) {
                $userAnswer->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, GameHasUser>
     */
    public function getGame(): Collection
    {
        return $this->game;
    }

    public function addGame(GameHasUser $game): self
    {
        if (!$this->game->contains($game)) {
            $this->game->add($game);
            $game->setUserId($this);
        }

        return $this;
    }

    public function removeGame(GameHasUser $game): self
    {
        if ($this->game->removeElement($game)) {
            // set the owning side to null (unless already changed)
            if ($game->getUserId() === $this) {
                $game->setUserId(null);
            }
        }

        return $this;
    }
}