<?php

namespace App\Controller\Quizz;

use App\Entity\Quizz\Quizz;
use App\Form\Quizz\QuizzType;
use App\Repository\Quizz\QuizzRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/backoffice/quizzs')]
class QuizzController extends AbstractController
{
    #[Route('/', name: 'app_quizz_quizz_index', methods: ['GET'])]
    public function index(QuizzRepository $quizzRepository): Response
    {
        return $this->render('quizz/quizz/index.html.twig', [
            'quizzs' => $quizzRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_quizz_quizz_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $quizz = new Quizz();
        $form = $this->createForm(QuizzType::class, $quizz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($quizz);
            $entityManager->flush();

            return $this->redirectToRoute('app_quizz_quizz_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('quizz/quizz/new.html.twig', [
            'quizz' => $quizz,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_quizz_quizz_show', methods: ['GET'])]
    public function show(Quizz $quizz): Response
    {
        return $this->render('quizz/quizz/show.html.twig', [
            'quizz' => $quizz,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_quizz_quizz_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Quizz $quizz, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(QuizzType::class, $quizz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_quizz_quizz_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('quizz/quizz/edit.html.twig', [
            'quizz' => $quizz,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_quizz_quizz_delete', methods: ['POST'])]
    public function delete(Request $request, Quizz $quizz, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$quizz->getId(), $request->request->get('_token'))) {
            $entityManager->remove($quizz);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_quizz_quizz_index', [], Response::HTTP_SEE_OTHER);
    }
}
