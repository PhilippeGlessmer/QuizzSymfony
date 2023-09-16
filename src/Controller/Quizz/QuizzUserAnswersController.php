<?php

namespace App\Controller\Quizz;

use App\Entity\Quizz\QuizzUserAnswers;
use App\Form\Quizz\QuizzUserAnswersType;
use App\Repository\Quizz\QuizzUserAnswersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/backoffice/quizz/user/answers')]
class QuizzUserAnswersController extends AbstractController
{
    #[Route('/', name: 'app_quizz_quizz_user_answers_index', methods: ['GET'])]
    public function index(QuizzUserAnswersRepository $quizzUserAnswersRepository): Response
    {
        return $this->render('quizz/quizz_user_answers/index.html.twig', [
            'quizz_user_answers' => $quizzUserAnswersRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_quizz_quizz_user_answers_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $quizzUserAnswer = new QuizzUserAnswers();
        $form = $this->createForm(QuizzUserAnswersType::class, $quizzUserAnswer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($quizzUserAnswer);
            $entityManager->flush();

            return $this->redirectToRoute('app_quizz_quizz_user_answers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('quizz/quizz_user_answers/new.html.twig', [
            'quizz_user_answer' => $quizzUserAnswer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_quizz_quizz_user_answers_show', methods: ['GET'])]
    public function show(QuizzUserAnswers $quizzUserAnswer): Response
    {
        return $this->render('quizz/quizz_user_answers/show.html.twig', [
            'quizz_user_answer' => $quizzUserAnswer,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_quizz_quizz_user_answers_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, QuizzUserAnswers $quizzUserAnswer, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(QuizzUserAnswersType::class, $quizzUserAnswer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_quizz_quizz_user_answers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('quizz/quizz_user_answers/edit.html.twig', [
            'quizz_user_answer' => $quizzUserAnswer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_quizz_quizz_user_answers_delete', methods: ['POST'])]
    public function delete(Request $request, QuizzUserAnswers $quizzUserAnswer, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$quizzUserAnswer->getId(), $request->request->get('_token'))) {
            $entityManager->remove($quizzUserAnswer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_quizz_quizz_user_answers_index', [], Response::HTTP_SEE_OTHER);
    }
}
