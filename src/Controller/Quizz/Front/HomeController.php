<?php

namespace App\Controller\Quizz\Front;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\Quizz\QuizzCategoriesRepository;
use App\Repository\Quizz\QuizzChoicesRepository;
use App\Repository\Quizz\QuizzQuestionsRepository;
use App\Repository\Quizz\QuizzRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{

    #[Route('/quizz/front/home', name: 'app_quizz_front_home')]
    public function index(): Response
    {
        return $this->render('quizz/front/home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }


    #[Route('/quizz/front', name: 'app_quizz_front_categories')]
    public function categories(QuizzCategoriesRepository $quizzcategorierepository): Response
    {
        return $this->render('quizz/front/catQuizz.html.twig', [
            'controller_name' => 'HomeController',
            'categories' => $quizzcategorierepository->findAll(),
        ]);
    }


    #[Route('/quizz/front/{id}', name: 'app_quizz_front_listequizz')]
    public function listequizz(QuizzCategoriesRepository $quizzcategorierepository, QuizzRepository $quizzrepository): Response
    {
        return $this->render('quizz/front/listQuizz.html.twig', [
            'controller_name' => 'HomeController',
            'categories' => $quizzcategorierepository->findAll(),
            'quizz' => $quizzrepository->findAll(),
        ]);
    }


    #[Route('/quizz/front/quizz', name: 'app_quizz_front_quizz')]
    public function quizz(QuizzRepository $quizzrepository, QuizzQuestionsRepository $quizzquestionrepository, QuizzChoicesRepository $quizzchoicerepository): Response
    {
        return $this->render('quizz/front/quizz.html.twig', [
            'controller_name' => 'HomeController',
            'quizz' => $quizzrepository->findAll(),
            'question' => $quizzquestionrepository->findAll(),
            // 'reponse' => $qu
        ]);
    }

}
