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
    private $obligation = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $exception = [];

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $limitation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Source", inversedBy="filters")
     * @ORM\JoinColumn(nullable=false)
     */
    private $source;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Board", inversedBy="filters")
     * @ORM\JoinColumn(nullable=false)
     */
    private $board;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getObligation(): ?array
    {
        return $this->obligation;
    }

    public function setObligation(?array $obligation): self
    {
        $this->obligation = $obligation;

        return $this;
    }

    public function getException(): ?array
    {
        return $this->exception;
    }

    public function setException(?array $exception): self
    {
        $this->exception = $exception;

        return $this;
    }

    public function getLimitation(): ?int
    {
        return $this->limitation;
    }

    public function setLimitation(?int $limitation): self
    {
        $this->limitation = $limitation;

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
