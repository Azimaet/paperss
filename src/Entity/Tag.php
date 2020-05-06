<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TagRepository")
 */
class Tag
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
    private $label;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\board", inversedBy="tags")
     */
    private $board;

    public function __construct()
    {
        $this->board = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection|board[]
     */
    public function getBoard(): Collection
    {
        return $this->board;
    }

    public function addBoard(board $board): self
    {
        if (!$this->board->contains($board)) {
            $this->board[] = $board;
        }

        return $this;
    }

    public function removeBoard(board $board): self
    {
        if ($this->board->contains($board)) {
            $this->board->removeElement($board);
        }

        return $this;
    }
}
