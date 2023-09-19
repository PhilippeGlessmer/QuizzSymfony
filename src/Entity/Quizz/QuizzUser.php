<?php

namespace App\Entity\Quizz;

use App\Entity\Utilisateur\User;
use App\Repository\Quizz\QuizzUserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuizzUserRepository::class)]
class QuizzUser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'quizzUsers')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'quizzUsers')]
    private ?Quizz $quizz = null;

    #[ORM\Column(nullable: true)]
    private ?int $score = null;

    #[ORM\OneToMany(mappedBy: 'userQuizz', targetEntity: QuizzUserAnswers::class)]
    private Collection $quizzUserAnswers;

    public function __construct()
    {
        $this->quizzUserAnswers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->getUser(); 
    }


    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getQuizz(): ?Quizz
    {
        return $this->quizz;
    }

    public function setQuizz(?Quizz $quizz): static
    {
        $this->quizz = $quizz;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(?int $score): static
    {
        $this->score = $score;

        return $this;
    }

    /**
     * @return Collection<int, QuizzUserAnswers>
     */
    public function getQuizzUserAnswers(): Collection
    {
        return $this->quizzUserAnswers;
    }

    public function addQuizzUserAnswer(QuizzUserAnswers $quizzUserAnswer): static
    {
        if (!$this->quizzUserAnswers->contains($quizzUserAnswer)) {
            $this->quizzUserAnswers->add($quizzUserAnswer);
            $quizzUserAnswer->setUserQuizz($this);
        }

        return $this;
    }

    public function removeQuizzUserAnswer(QuizzUserAnswers $quizzUserAnswer): static
    {
        if ($this->quizzUserAnswers->removeElement($quizzUserAnswer)) {
            // set the owning side to null (unless already changed)
            if ($quizzUserAnswer->getUserQuizz() === $this) {
                $quizzUserAnswer->setUserQuizz(null);
            }
        }

        return $this;
    }
}
