<?php

namespace App\Controller\Quizz;

use App\Entity\Quizz\QuizzIllustrations;
use App\Form\Quizz\QuizzIllustrationsType;
use App\Repository\Quizz\QuizzIllustrationsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/backoffice/quizz/illustrations')]
class QuizzIllustrationsController extends AbstractController
{
    #[Route('/', name: 'app_quizz_quizz_illustrations_index', methods: ['GET'])]
    public function index(QuizzIllustrationsRepository $quizzIllustrationsRepository): Response
    {
        return $this->render('quizz/quizz_illustrations/index.html.twig', [
            'quizz_illustrations' => $quizzIllustrationsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_quizz_quizz_illustrations_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $quizzIllustration = new QuizzIllustrations();
        $form = $this->createForm(QuizzIllustrationsType::class, $quizzIllustration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($quizzIllustration);
            $entityManager->flush();

            return $this->redirectToRoute('app_quizz_quizz_illustrations_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('quizz/quizz_illustrations/new.html.twig', [
            'quizz_illustration' => $quizzIllustration,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_quizz_quizz_illustrations_show', methods: ['GET'])]
    public function show(QuizzIllustrations $quizzIllustration): Response
    {
        return $this->render('quizz/quizz_illustrations/show.html.twig', [
            'quizz_illustration' => $quizzIllustration,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_quizz_quizz_illustrations_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, QuizzIllustrations $quizzIllustration, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(QuizzIllustrationsType::class, $quizzIllustration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_quizz_quizz_illustrations_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('quizz/quizz_illustrations/edit.html.twig', [
            'quizz_illustration' => $quizzIllustration,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_quizz_quizz_illustrations_delete', methods: ['POST'])]
    public function delete(Request $request, QuizzIllustrations $quizzIllustration, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$quizzIllustration->getId(), $request->request->get('_token'))) {
            $entityManager->remove($quizzIllustration);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_quizz_quizz_illustrations_index', [], Response::HTTP_SEE_OTHER);
    }
}
