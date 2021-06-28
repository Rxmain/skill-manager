<?php

namespace App\Entity;

use App\Repository\CompetencesRepository;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Boolean;

/**
 * @ORM\Entity(repositoryClass=CompetencesRepository::class)
 *
 */
class Competences
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="competences")
     */
    private $user;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $competencelike;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $levelcompetence;


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

    public function __toString()
    {
       return $this->name;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCompetencelike(): ?bool
    {
        return $this->competencelike;
    }

    public function setCompetencelike(?bool $competencelike): self
    {
        $this->competencelike = $competencelike;

        return $this;
    }

    public function getLevelcompetence(): ?int
    {
        return $this->levelcompetence;
    }

    public function setLevelcompetence(?int $levelcompetence): self
    {
        $this->levelcompetence = $levelcompetence;

        return $this;
    }



}
