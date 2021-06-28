<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
//use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints\DateTime;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @Vich\Uploadable()
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string", nullable=true)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="smallint")
     */
    private $age;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $profession;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $postalcode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $Collab;


    /**
     * @ORM\OneToMany(targetEntity=Experience::class, mappedBy="user")
     */
    private $experiences;
//
//    /**
//     * @ORM\Column (type="string", length=100, nullable=true)
//     */
//    private $thumbnail;
//
//    /**
//     * @Vich\UploadableField(mapping="thumbnails", fileNameProperty="thumbnail")
//     *
//     */
//    private $thumbnailFile;

//    /**
//     * @ORM\Column (type="datetime", nullable=true)
//     */
//    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity=Competences::class, mappedBy="user")
     */
    private $competences;

    /**
//     * @return mixed
     */
//    public function getThumbnailFile(): ?array
//    {
//        return $this->thumbnailFile;
//    }
//
//    /**
//     * @param mixed $thumbnailFile
//     */
//    public function setThumbnailFile($thumbnailFile = null)
//    {
//        $this->thumbnailFile = $thumbnailFile;
//        if( null !== $thumbnailFile) {
//            $this->updatedAt = new \DateTime();
//        }
//    }

//    /**
//     * @return mixed
//     */
//    public function getThumbnail()
//    {
//        return $this->thumbnail;
//    }
//
//    /**
//     * @param mixed $thumbnail
//     */
//    public function setThumbnail($thumbnail): void
//    {
//        $this->thumbnail = $thumbnail;
//    }

    public function __construct()
    {
        $this->competences = new ArrayCollection();
        $this->experiences = new ArrayCollection();
//        $this->updatedAt = new DateTime();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
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
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUsername()
    {
        // TODO: Implement getUsername() method.
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

//    public function getCompetences(): Collection
//    {
//        return $this->competences;
//    }
//
//    public function setCompetences(?Competences $competences): self
//    {
//        $this->competences = $competences;
//
//        return $this;
//    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getProfession(): ?string
    {
        return $this->profession;
    }

    public function setProfession(string $profession): self
    {
        $this->profession = $profession;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getPostalcode(): ?string
    {
        return $this->postalcode;
    }

    public function setPostalcode(string $postalcode): self
    {
        $this->postalcode = $postalcode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCollab(): ?bool
    {
        return $this->Collab;
    }

    public function setCollab(?bool $Collab): self
    {
        $this->Collab = $Collab;

        return $this;
    }
    public function __toString()
    {
        return $this->firstname;
    }

    /**
     * @return Collection|Competences[]
     */
    public function getCompetences(): Collection
    {
        return $this->competences;
    }

    public function addCompetence(Competences $competence): self
    {
        if (!$this->competences->contains($competence)) {
            $this->competences[] = $competence;
        }

        return $this;
    }

    public function removeCompetence(Competences $competence): self
    {
        $this->competences->removeElement($competence);

        return $this;
    }

    /**
     * @return Collection|Experience[]
     */
    public function getExperiences(): Collection
    {
        return $this->experiences;
    }

    public function addExperience(Experience $experience): self
    {
        if (!$this->experiences->contains($experience)) {
            $this->experiences[] = $experience;
            $experience->setUser($this);
        }

        return $this;
    }

    public function removeExperience(Experience $experience): self
    {
        if ($this->experiences->removeElement($experience)) {
            // set the owning side to null (unless already changed)
            if ($experience->getUser() === $this) {
                $experience->setUser(null);
            }
        }

        return $this;
    }

//    public function getUpdatedAt(): ?\DateTimeInterface
//    {
//        return $this->updatedAt;
//    }
//
//    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
//    {
//        $this->updatedAt = $updatedAt;
//
//        return $this;
//    }

//    public function getFile(): ?File
//    {
//        return $this->file;
//    }
//
//    public function setFile(?File $file): self
//    {
//        // unset the owning side of the relation if necessary
//        if ($file === null && $this->file !== null) {
//            $this->file->setUser(null);
//        }
//
//        // set the owning side of the relation if necessary
//        if ($file !== null && $file->getUser() !== $this) {
//            $file->setUser($this);
//        }
//
//        $this->file = $file;
//
//        return $this;
//    }




}
