<?php

namespace App\Entity;

use App\Repository\UserRepository;
use App\Validator\PasswordStrength;
use App\Validator\UniqueEmail;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ClassMetadata;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Mapping\ClassMetadata as MappingClassMetadata;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
//#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]

class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 180, unique: true)]

     /**
     * @Assert\NotBlank(message="Email is required.")
     * @Assert\Email(message="Plase enter a valid email.")
     * @UniqueEmail
     */
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];


    #[ORM\Column(type: 'string', nullable: true)]
   
    private ?string $password = null;

    #[ORM\Column]
    private bool $isVerified = false;

    #[ORM\Column(type: 'string', length: 64, nullable: true)]
    private ?string $verificationToken = null;

    /**
     * @var Collection<int, Attachment>
     */
    #[ORM\OneToMany(targetEntity: Attachment::class, mappedBy: 'uploadedBy', orphanRemoval: true)]
    private Collection $attachments;

    /**
     * @var Collection<int, Post>
     */
    #[ORM\OneToMany(targetEntity: Post::class, mappedBy: 'author')]
    private Collection $posts;

    public function __construct()
    {
        $this->attachments = new ArrayCollection();
        $this->posts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

   
    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
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
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
  
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getVerificationToken(): ?string
    {
        return $this->verificationToken;
    }

    public function setVerificationToken(?string $verificationToken): self
    {
        $this->verificationToken = $verificationToken;

        return $this;
    }

    /**
     * @return Collection<int, Attachment>
     */
    public function getAttachments(): Collection
    {
        return $this->attachments;
    }

    public function addAttachment(Attachment $attachment): static
    {
        if (!$this->attachments->contains($attachment)) {
            $this->attachments->add($attachment);
            $attachment->setUploadedBy($this);
        }

        return $this;
    }

    public function removeAttachment(Attachment $attachment): static
    {
        if ($this->attachments->removeElement($attachment)) {
            if ($attachment->getUploadedBy() === $this) {
                $attachment->setUploadedBy(null);
            }
        }

        return $this;
    }

    public static function loadValidatorMetadata(MappingClassMetadata $metadata){
        
        $metadata->addPropertyConstraint('email', new UniqueEmail([
            'message'=> 'validators.email_exists' ]));
    }

    /**
     * @return Collection<int, Post>
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): static
    {
        if (!$this->posts->contains($post)) {
            $this->posts->add($post);
            $post->setAuthor($this);
        }

        return $this;
    }

    public function removePost(Post $post): static
    {
        if ($this->posts->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getAuthor() === $this) {
                $post->setAuthor(null);
            }
        }

        return $this;
    }
}
