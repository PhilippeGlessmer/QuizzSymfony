<?php

namespace App\Controller\Quizz;

use App\Entity\Quizz\QuizzCategories;
use App\Form\Quizz\QuizzCategoriesType;
use App\Repository\Quizz\QuizzCategoriesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('backoffice/quizz/categories')]
class QuizzCategoriesController extends AbstractController
{
    #[Route('/', name: 'app_quizz_quizz_categories_index', methods: ['GET'])]
    public function index(QuizzCategoriesRepository $quizzCategoriesRepository): Response
    {
        return $this->render('quizz/quizz_categories/index.html.twig', [
            'quizz_categories' => $quizzCategoriesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_quizz_quizz_categories_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $quizzCategory = new QuizzCategories();
        $form = $this->createForm(QuizzCategoriesType::class, $quizzCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($quizzCategory);
            $entityManager->flush();

            return $this->redirectToRoute('app_quizz_quizz_categories_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('quizz/quizz_categories/new.html.twig', [
            'quizz_category' => $quizzCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_quizz_quizz_categories_show', methods: ['GET'])]
    public function show(QuizzCategories $quizzCategory): Response
    {
        return $this->render('quizz/quizz_categories/show.html.twig', [
            'quizz_category' => $quizzCategory,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_quizz_quizz_categories_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, QuizzCategories $quizzCategory, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(QuizzCategoriesType::class, $quizzCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_quizz_quizz_categories_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('quizz/quizz_categories/edit.html.twig', [
            'quizz_category' => $quizzCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_quizz_quizz_categories_delete', methods: ['POST'])]
    public function delete(Request $request, QuizzCategories $quizzCategory, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$quizzCategory->getId(), $request->request->get('_token'))) {
            $entityManager->remove($quizzCategory);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_quizz_quizz_categories_index', [], Response::HTTP_SEE_OTHER);
    }
}
