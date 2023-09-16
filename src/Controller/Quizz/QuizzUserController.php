<?php

namespace App\Controller\Quizz;

use App\Entity\Quizz\QuizzUser;
use App\Form\Quizz\QuizzUserType;
use App\Repository\Quizz\QuizzUserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/backoffice/quizz/user')]
class QuizzUserController extends AbstractController
{
    #[Route('/', name: 'app_quizz_quizz_user_index', methods: ['GET'])]
    public function index(QuizzUserRepository $quizzUserRepository): Response
    {
        return $this->render('quizz/quizz_user/index.html.twig', [
            'quizz_users' => $quizzUserRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_quizz_quizz_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $quizzUser = new QuizzUser();
        $form = $this->createForm(QuizzUserType::class, $quizzUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($quizzUser);
            $entityManager->flush();

            return $this->redirectToRoute('app_quizz_quizz_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('quizz/quizz_user/new.html.twig', [
            'quizz_user' => $quizzUser,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_quizz_quizz_user_show', methods: ['GET'])]
    public function show(QuizzUser $quizzUser): Response
    {
        return $this->render('quizz/quizz_user/show.html.twig', [
            'quizz_user' => $quizzUser,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_quizz_quizz_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, QuizzUser $quizzUser, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(QuizzUserType::class, $quizzUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_quizz_quizz_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('quizz/quizz_user/edit.html.twig', [
            'quizz_user' => $quizzUser,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_quizz_quizz_user_delete', methods: ['POST'])]
    public function delete(Request $request, QuizzUser $quizzUser, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$quizzUser->getId(), $request->request->get('_token'))) {
            $entityManager->remove($quizzUser);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_quizz_quizz_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
