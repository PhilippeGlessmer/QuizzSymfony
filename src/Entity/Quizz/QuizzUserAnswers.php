<?php

namespace App\Entity\Quizz;

use App\Repository\Quizz\QuizzUserAnswersRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuizzUserAnswersRepository::class)]
class QuizzUserAnswers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'quizzUserAnswers')]
    private ?QuizzUser $userQuizz = null;

    #[ORM\ManyToOne(inversedBy: 'quizzUserAnswers')]
    private ?QuizzQuestions $question = null;

    #[ORM\ManyToOne(inversedBy: 'quizzUserAnswers')]
    private ?QuizzChoices $choice = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->getUserQuizz(); 
    }


    public function getUserQuizz(): ?QuizzUser
    {
        return $this->userQuizz;
    }

    public function setUserQuizz(?QuizzUser $userQuizz): static
    {
        $this->userQuizz = $userQuizz;

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

    public function getChoice(): ?QuizzChoices
    {
        return $this->choice;
    }

    public function setChoice(?QuizzChoices $choice): static
    {
        $this->choice = $choice;

        return $this;
    }
}
