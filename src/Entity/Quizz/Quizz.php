<?php

namespace App\Entity\Quizz;

use App\Repository\Quizz\QuizzRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuizzRepository::class)]
class Quizz
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToMany(targetEntity: QuizzCategories::class, inversedBy: 'quizzs')]
    private Collection $categorie;

    #[ORM\OneToMany(mappedBy: 'quizz', targetEntity: QuizzQuestions::class)]
    private Collection $quizzQuestions;

    #[ORM\OneToMany(mappedBy: 'quizz', targetEntity: QuizzIllustrations::class)]
    private Collection $quizzIllustrations;

    #[ORM\OneToMany(mappedBy: 'quizz', targetEntity: QuizzUser::class)]
    private Collection $quizzUsers;

    public function __construct()
    {
        $this->categorie = new ArrayCollection();
        $this->quizzQuestions = new ArrayCollection();
        $this->quizzIllustrations = new ArrayCollection();
        $this->quizzUsers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
{
    return $this->getTitle(); 
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

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, QuizzCategories>
     */
    public function getCategorie(): Collection
    {
        return $this->categorie;
    }

    public function addCategorie(QuizzCategories $categorie): static
    {
        if (!$this->categorie->contains($categorie)) {
            $this->categorie->add($categorie);
        }

        return $this;
    }

    public function removeCategorie(QuizzCategories $categorie): static
    {
        $this->categorie->removeElement($categorie);

        return $this;
    }

    /**
     * @return Collection<int, QuizzQuestions>
     */
    public function getQuizzQuestions(): Collection
    {
        return $this->quizzQuestions;
    }

    public function addQuizzQuestion(QuizzQuestions $quizzQuestion): static
    {
        if (!$this->quizzQuestions->contains($quizzQuestion)) {
            $this->quizzQuestions->add($quizzQuestion);
            $quizzQuestion->setQuizz($this);
        }

        return $this;
    }

    public function removeQuizzQuestion(QuizzQuestions $quizzQuestion): static
    {
        if ($this->quizzQuestions->removeElement($quizzQuestion)) {
            // set the owning side to null (unless already changed)
            if ($quizzQuestion->getQuizz() === $this) {
                $quizzQuestion->setQuizz(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, QuizzIllustrations>
     */
    public function getQuizzIllustrations(): Collection
    {
        return $this->quizzIllustrations;
    }

    public function addQuizzIllustration(QuizzIllustrations $quizzIllustration): static
    {
        if (!$this->quizzIllustrations->contains($quizzIllustration)) {
            $this->quizzIllustrations->add($quizzIllustration);
            $quizzIllustration->setQuizz($this);
        }

        return $this;
    }

    public function removeQuizzIllustration(QuizzIllustrations $quizzIllustration): static
    {
        if ($this->quizzIllustrations->removeElement($quizzIllustration)) {
            // set the owning side to null (unless already changed)
            if ($quizzIllustration->getQuizz() === $this) {
                $quizzIllustration->setQuizz(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, QuizzUser>
     */
    public function getQuizzUsers(): Collection
    {
        return $this->quizzUsers;
    }

    public function addQuizzUser(QuizzUser $quizzUser): static
    {
        if (!$this->quizzUsers->contains($quizzUser)) {
            $this->quizzUsers->add($quizzUser);
            $quizzUser->setQuizz($this);
        }

        return $this;
    }

    public function removeQuizzUser(QuizzUser $quizzUser): static
    {
        if ($this->quizzUsers->removeElement($quizzUser)) {
            // set the owning side to null (unless already changed)
            if ($quizzUser->getQuizz() === $this) {
                $quizzUser->setQuizz(null);
            }
        }

        return $this;
    }
}
