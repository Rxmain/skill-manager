<?php

namespace App\Entity;

use App\Repository\ExperienceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExperienceRepository::class)
 */
class Experience
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
    private $Function;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Place;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $context;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $realisations;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $technical_environment;

    /**
     * @ORM\Column(type="date")
     */
    private $start_date;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $end_date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=TypeExperience::class, inversedBy="experiences")
     */
    private $type_experience;

    /**
     * @ORM\ManyToOne(targetEntity=Entreprise::class, inversedBy="experiences")
     */
    private $entreprise;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFunction(): ?string
    {
        return $this->Function;
    }

    public function setFunction(string $Function): self
    {
        $this->Function = $Function;

        return $this;
    }

    public function getPlace(): ?string
    {
        return $this->Place;
    }

    public function setPlace(string $Place): self
    {
        $this->Place = $Place;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getContext(): ?string
    {
        return $this->context;
    }

    public function setContext(string $context): self
    {
        $this->context = $context;

        return $this;
    }

    public function getRealisations(): ?string
    {
        return $this->realisations;
    }

    public function setRealisations(string $realisations): self
    {
        $this->realisations = $realisations;

        return $this;
    }

    public function getTechnicalEnvironment(): ?string
    {
        return $this->technical_environment;
    }

    public function setTechnicalEnvironment(string $technical_environment): self
    {
        $this->technical_environment = $technical_environment;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTimeInterface $start_date): self
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(?\DateTimeInterface $end_date): self
    {
        $this->end_date = $end_date;

        return $this;
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

    public function getTypeExperience(): ?TypeExperience
    {
        return $this->type_experience;
    }

    public function setTypeExperience(?TypeExperience $type_experience): self
    {
        $this->type_experience = $type_experience;

        return $this;
    }

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }
}
