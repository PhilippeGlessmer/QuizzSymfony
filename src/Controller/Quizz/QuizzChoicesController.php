<?php

namespace App\Controller\Quizz;

use App\Entity\Quizz\QuizzChoices;
use App\Form\Quizz\QuizzChoicesType;
use App\Repository\Quizz\QuizzChoicesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/backoffice/quizz/choices')]
class QuizzChoicesController extends AbstractController
{
    #[Route('/', name: 'app_quizz_quizz_choices_index', methods: ['GET'])]
    public function index(QuizzChoicesRepository $quizzChoicesRepository): Response
    {
        return $this->render('quizz/quizz_choices/index.html.twig', [
            'quizz_choices' => $quizzChoicesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_quizz_quizz_choices_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $quizzChoice = new QuizzChoices();
        $form = $this->createForm(QuizzChoicesType::class, $quizzChoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($quizzChoice);
            $entityManager->flush();

            return $this->redirectToRoute('app_quizz_quizz_choices_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('quizz/quizz_choices/new.html.twig', [
            'quizz_choice' => $quizzChoice,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_quizz_quizz_choices_show', methods: ['GET'])]
    public function show(QuizzChoices $quizzChoice): Response
    {
        return $this->render('quizz/quizz_choices/show.html.twig', [
            'quizz_choice' => $quizzChoice,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_quizz_quizz_choices_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, QuizzChoices $quizzChoice, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(QuizzChoicesType::class, $quizzChoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_quizz_quizz_choices_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('quizz/quizz_choices/edit.html.twig', [
            'quizz_choice' => $quizzChoice,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_quizz_quizz_choices_delete', methods: ['POST'])]
    public function delete(Request $request, QuizzChoices $quizzChoice, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$quizzChoice->getId(), $request->request->get('_token'))) {
            $entityManager->remove($quizzChoice);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_quizz_quizz_choices_index', [], Response::HTTP_SEE_OTHER);
    }
}
