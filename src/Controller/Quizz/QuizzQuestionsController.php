<?php

namespace App\Controller\Quizz;

use App\Entity\Quizz\QuizzQuestions;
use App\Form\Quizz\QuizzQuestionsType;
use App\Repository\Quizz\QuizzQuestionsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/backoffice/quizz/questions')]
class QuizzQuestionsController extends AbstractController
{
    #[Route('/', name: 'app_quizz_quizz_questions_index', methods: ['GET'])]
    public function index(QuizzQuestionsRepository $quizzQuestionsRepository): Response
    {
        return $this->render('quizz/quizz_questions/index.html.twig', [
            'quizz_questions' => $quizzQuestionsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_quizz_quizz_questions_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $quizzQuestion = new QuizzQuestions();
        $form = $this->createForm(QuizzQuestionsType::class, $quizzQuestion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($quizzQuestion);
            $entityManager->flush();

            return $this->redirectToRoute('app_quizz_quizz_questions_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('quizz/quizz_questions/new.html.twig', [
            'quizz_question' => $quizzQuestion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_quizz_quizz_questions_show', methods: ['GET'])]
    public function show(QuizzQuestions $quizzQuestion): Response
    {
        return $this->render('quizz/quizz_questions/show.html.twig', [
            'quizz_question' => $quizzQuestion,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_quizz_quizz_questions_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, QuizzQuestions $quizzQuestion, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(QuizzQuestionsType::class, $quizzQuestion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_quizz_quizz_questions_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('quizz/quizz_questions/edit.html.twig', [
            'quizz_question' => $quizzQuestion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_quizz_quizz_questions_delete', methods: ['POST'])]
    public function delete(Request $request, QuizzQuestions $quizzQuestion, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$quizzQuestion->getId(), $request->request->get('_token'))) {
            $entityManager->remove($quizzQuestion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_quizz_quizz_questions_index', [], Response::HTTP_SEE_OTHER);
    }
}
