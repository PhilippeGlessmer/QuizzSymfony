<?php

namespace App\Entity\Quizz;

use App\Repository\Quizz\QuizzQuestionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuizzQuestionsRepository::class)]
class QuizzQuestions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $question = null;

    #[ORM\ManyToOne(inversedBy: 'quizzQuestions')]
    private ?Quizz $quizz = null;

    #[ORM\OneToMany(mappedBy: 'question', targetEntity: QuizzChoices::class)]
    private Collection $quizzChoices;

    #[ORM\OneToMany(mappedBy: 'question', targetEntity: QuizzIllustrations::class)]
    private Collection $quizzIllustrations;

    #[ORM\OneToMany(mappedBy: 'question', targetEntity: QuizzUserAnswers::class)]
    private Collection $quizzUserAnswers;

    public function __construct()
    {
        $this->quizzChoices = new ArrayCollection();
        $this->quizzIllustrations = new ArrayCollection();
        $this->quizzUserAnswers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): static
    {
        $this->question = $question;

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

    /**
     * @return Collection<int, QuizzChoices>
     */
    public function getQuizzChoices(): Collection
    {
        return $this->quizzChoices;
    }

    public function addQuizzChoice(QuizzChoices $quizzChoice): static
    {
        if (!$this->quizzChoices->contains($quizzChoice)) {
            $this->quizzChoices->add($quizzChoice);
            $quizzChoice->setQuestion($this);
        }

        return $this;
    }

    public function removeQuizzChoice(QuizzChoices $quizzChoice): static
    {
        if ($this->quizzChoices->removeElement($quizzChoice)) {
            // set the owning side to null (unless already changed)
            if ($quizzChoice->getQuestion() === $this) {
                $quizzChoice->setQuestion(null);
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
            $quizzIllustration->setQuestion($this);
        }

        return $this;
    }

    public function removeQuizzIllustration(QuizzIllustrations $quizzIllustration): static
    {
        if ($this->quizzIllustrations->removeElement($quizzIllustration)) {
            // set the owning side to null (unless already changed)
            if ($quizzIllustration->getQuestion() === $this) {
                $quizzIllustration->setQuestion(null);
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
            $quizzUserAnswer->setQuestion($this);
        }

        return $this;
    }

    public function removeQuizzUserAnswer(QuizzUserAnswers $quizzUserAnswer): static
    {
        if ($this->quizzUserAnswers->removeElement($quizzUserAnswer)) {
            // set the owning side to null (unless already changed)
            if ($quizzUserAnswer->getQuestion() === $this) {
                $quizzUserAnswer->setQuestion(null);
            }
        }

        return $this;
    }
}
