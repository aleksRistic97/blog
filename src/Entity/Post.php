<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: PostRepository::class)]
#[UniqueEntity(fields: ['slug'], message: 'unique_slug')]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['post_list'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['post_list'])]
    #[Assert\NotNull(message: 'Title cannot be null')]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Assert\NotNull(message: 'Description cannot be null')]
    #[Groups(['post_list'])]
    private ?string $description = null;

    #[ORM\Column(length: 50, unique:true)]
    #[Groups(['post_list'])]
    #[Assert\NotNull(message: 'Slug cannot be null')]
    private ?string $slug = null;

    /**
     * @var Collection<int, Tag>
     */
    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'posts')]
    #[Groups(['post_list'])]
    #[Assert\NotNull(message: 'You should have at least one tag')]
    private Collection $tags;

    #[ORM\ManyToOne(inversedBy: 'posts')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['post_list'])]
    #[Assert\NotNull(message: 'Category cannot be null')]
    private ?Category $category = null;

    /**
     * @var Collection<int, Attachment>
     */
    #[ORM\OneToMany(targetEntity: Attachment::class, mappedBy: 'post', orphanRemoval: true)]
    private Collection $attachments;

    /**
     * @var Collection<int, Comment>
     */
    #[ORM\OneToMany(targetEntity: Comment::class, mappedBy: 'post')]
    private Collection $comments;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'posts')]
    private ?User $author = null;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->attachments = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): static
    {
        if (!$this->tags->contains($tag))
        {

            $this->tags->add($tag);

        }

        return $this;
    }

    public function removeTag(Tag $tag): static
    {
        $this->tags->removeElement($tag);

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getParentCategory(): ?Category
    {
        if ($this->category->getCategory())
        {

            return $this->category->getCategory();

        }

        return null;
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
        if (!$this->attachments->contains($attachment))
        {

            $this->attachments->add($attachment);
            $attachment->setPost($this);

        }

        return $this;
    }

    public function removeAttachment(Attachment $attachment): static
    {
        if ($this->attachments->removeElement($attachment))
        {

            if ($attachment->getPost() === $this)
            {

                $attachment->setPost(null);

            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comments->contains($comment))
        {

            $this->comments->add($comment);
            $comment->setPost($this);

        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment))
        {

            if ($comment->getPost() === $this)
            {

                $comment->setPost(null);

            }
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): static
    {
        $this->author = $author;

        return $this;
    }
}
