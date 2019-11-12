<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TopicRepository")
 */
class Topic
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Topic", inversedBy="child_topics")
     */
    private $parent_topic;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Topic", mappedBy="parent_topic")
     */
    private $child_topics;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Article", mappedBy="topic")
     */
    private $articles;

    public function __construct()
    {
        $this->child_topics = new ArrayCollection();
        $this->articles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getParentTopic(): ?self
    {
        return $this->parent_topic;
    }

    public function setParentTopic(?self $parent_topic): self
    {
        $this->parent_topic = $parent_topic;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getChildTopics(): Collection
    {
        return $this->child_topics;
    }

    public function addChildTopic(self $childTopic): self
    {
        if (!$this->child_topics->contains($childTopic)) {
            $this->child_topics[] = $childTopic;
            $childTopic->setParentTopic($this);
        }

        return $this;
    }

    public function removeChildTopic(self $childTopic): self
    {
        if ($this->child_topics->contains($childTopic)) {
            $this->child_topics->removeElement($childTopic);
            // set the owning side to null (unless already changed)
            if ($childTopic->getParentTopic() === $this) {
                $childTopic->setParentTopic(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Article[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->setTopic($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->contains($article)) {
            $this->articles->removeElement($article);
            // set the owning side to null (unless already changed)
            if ($article->getTopic() === $this) {
                $article->setTopic(null);
            }
        }

        return $this;
    }
}
