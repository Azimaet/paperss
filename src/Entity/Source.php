<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SourceRepository")
 */
class Source
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
    private $url;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $icon;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $filterMustContain = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $filterMustExclude = [];

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $filterLimitItems;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Board", inversedBy="sources")
     * @ORM\JoinColumn(nullable=false)
     */
    private $board;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    public function getFilterMustContain(): ?array
    {
        return $this->filterMustContain;
    }

    public function setFilterMustContain(?array $filterMustContain): self
    {
        $this->filterMustContain = $filterMustContain;

        return $this;
    }

    public function getFilterMustExclude(): ?array
    {
        return $this->filterMustExclude;
    }

    public function setFilterMustExclude(?array $filterMustExclude): self
    {
        $this->filterMustExclude = $filterMustExclude;

        return $this;
    }

    public function getFilterLimitItems(): ?int
    {
        return $this->filterLimitItems;
    }

    public function setFilterLimitItems(?int $filterLimitItems): self
    {
        $this->filterLimitItems = $filterLimitItems;

        return $this;
    }

    public function getBoard(): ?Board
    {
        return $this->board;
    }

    public function setBoard(?Board $board): self
    {
        $this->board = $board;

        return $this;
    }
}
