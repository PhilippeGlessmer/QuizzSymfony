<?php

namespace App\Entity\Quizz;

use App\Repository\Quizz\QuizzChoicesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuizzChoicesRepository::class)]
class QuizzChoices
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $reponse = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isCorrect = null;

    #[ORM\ManyToOne(inversedBy: 'quizzChoices')]
    private ?QuizzQuestions $question = null;

    #[ORM\OneToMany(mappedBy: 'reponses', targetEntity: QuizzIllustrations::class)]
    private Collection $quizzIllustrations;

    #[ORM\OneToMany(mappedBy: 'choice', targetEntity: QuizzUserAnswers::class)]
    private Collection $quizzUserAnswers;

    public function __construct()
    {
        $this->quizzIllustrations = new ArrayCollection();
        $this->quizzUserAnswers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->getReponse(); 
    }
    

    public function getReponse(): ?string
    {
        return $this->reponse;
    }

    public function setReponse(string $reponse): static
    {
        $this->reponse = $reponse;

        return $this;
    }

    public function isIsCorrect(): ?bool
    {
        return $this->isCorrect;
    }

    public function setIsCorrect(?bool $isCorrect): static
    {
        $this->isCorrect = $isCorrect;

        return $this;
    }

    public function getQuestion(): ?QuizzQuestions
    {
        return $this->question;
    }

    public function setQuestion(?QuizzQuestions $question): static
    {
        $this->question = $question;

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
            $quizzIllustration->setReponses($this);
        }

        return $this;
    }

    public function removeQuizzIllustration(QuizzIllustrations $quizzIllustration): static
    {
        if ($this->quizzIllustrations->removeElement($quizzIllustration)) {
            // set the owning side to null (unless already changed)
            if ($quizzIllustration->getReponses() === $this) {
                $quizzIllustration->setReponses(null);
            }
        }

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
            $quizzUserAnswer->setChoice($this);
        }

        return $this;
    }

    public function removeQuizzUserAnswer(QuizzUserAnswers $quizzUserAnswer): static
    {
        if ($this->quizzUserAnswers->removeElement($quizzUserAnswer)) {
            // set the owning side to null (unless already changed)
            if ($quizzUserAnswer->getChoice() === $this) {
                $quizzUserAnswer->setChoice(null);
            }
        }

        return $this;
    }
}
