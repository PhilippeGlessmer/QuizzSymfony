<?php

namespace App\Entity\Quizz;

use App\Repository\Quizz\QuizzIllustrationsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuizzIllustrationsRepository::class)]
class QuizzIllustrations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $file = null;

    #[ORM\ManyToOne(inversedBy: 'quizzIllustrations')]
    private ?Quizz $quizz = null;

    #[ORM\ManyToOne(inversedBy: 'quizzIllustrations')]
    private ?QuizzQuestions $question = null;

    #[ORM\ManyToOne(inversedBy: 'quizzIllustrations')]
    private ?QuizzChoices $reponses = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->getFile(); 
    }


    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(?string $file): static
    {
        $this->file = $file;

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

    public function getQuestion(): ?QuizzQuestions
    {
        return $this->question;
    }

    public function setQuestion(?QuizzQuestions $question): static
    {
        $this->question = $question;

        return $this;
    }

    public function getReponses(): ?QuizzChoices
    {
        return $this->reponses;
    }

    public function setReponses(?QuizzChoices $reponses): static
    {
        $this->reponses = $reponses;

        return $this;
    }
}
