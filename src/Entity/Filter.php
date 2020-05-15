<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FilterRepository")
 */
class Filter
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $must_contain = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $must_exclude = [];

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $limit_items;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $limit_days;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Board", inversedBy="filters")
     * @ORM\JoinColumn(nullable=false)
     */
    private $board;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Source")
     * @ORM\JoinColumn(nullable=false)
     */
    private $source;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMustContain(): ?array
    {
        return $this->must_contain;
    }

    public function setMustContain(?array $must_contain): self
    {
        $this->must_contain = $must_contain;

        return $this;
    }

    public function getMustExclude(): ?array
    {
        return $this->must_exclude;
    }

    public function setMustExclude(?array $must_exclude): self
    {
        $this->must_exclude = $must_exclude;

        return $this;
    }

    public function getLimitItems(): ?int
    {
        return $this->limit_items;
    }

    public function setLimitItems(?int $limit_items): self
    {
        $this->limit_items = $limit_items;

        return $this;
    }

    public function getLimitDays(): ?int
    {
        return $this->limit_days;
    }

    public function setLimitDays(?int $limit_days): self
    {
        $this->limit_days = $limit_days;

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

    public function getSource(): ?Source
    {
        return $this->source;
    }

    public function setSource(?Source $source): self
    {
        $this->source = $source;

        return $this;
    }
}
