<?php

namespace App\Entity;

use App\Repository\BlogPostRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="blog_post")
 * @ORM\Entity(repositoryClass=BlogPostRepository::class)
 * @ORM\HasLifecycleCallbacks
 */
class BlogPost
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(name="description", type="string", length=2000)
     */
    private $description;

    /**
     * @ORM\Column(name="body", type="text")
     */
    private $body;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $author;

    /**
     * @ORM\Column(name="created_on", type="datetime")
     */
    private $createdOn;

    /**
     * @ORM\Column(name="updated_on", type="datetime")
     */
    private $updatedOn;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getCreatedOn(): ?\DateTime
    {
        return $this->createdOn;
    }

    public function setCreatedOn(\DateTime $createdOn): self
    {
        $this->createdOn = $createdOn;

        return $this;
    }

    public function getUpdatedOn(): ?\DateTime
    {
        return $this->updatedOn;
    }

    public function setUpdatedOn(\DateTime $updatedOn): self
    {
        $this->updatedOn = $updatedOn;

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        if(!$this->getCreatedOn())
        {
            $this->setCreatedOn(new \DateTime());
        }

        if(!$this->getUpdatedOn())
        {
            $this->setUpdatedOn(new \DateTime());
        }
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->setUpdatedOn(new \DateTime());
    }
}