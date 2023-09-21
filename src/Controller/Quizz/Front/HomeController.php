<?php

namespace App\Controller\Quizz\Front;

use App\Entity\Quizz\Quizz;
use App\Entity\Quizz\QuizzCategories;
use App\Repository\Quizz\QuizzRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\Quizz\QuizzChoicesRepository;
use App\Repository\Quizz\QuizzQuestionsRepository;
use App\Repository\Quizz\QuizzCategoriesRepository;
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
    public function listequizz(QuizzCategories $quizzcategorie): Response
    {
        return $this->render('quizz/front/listQuizz.html.twig', [
            'controller_name' => 'HomeController',
            'categories' => $quizzcategorie,
        ]);
    }


    #[Route('/quizz/front/quizz/{id}', name: 'app_quizz_front_quizz')]
    public function quizz(Quizz $quizz , Request $request): Response
    {

        if ($request->isMethod('POST')){
            $answers = $request->request->get('answers');
            dd($request);
        }

        return $this->render('quizz/front/quizz.html.twig', [
            'controller_name' => 'HomeController',
            'quizz' => $quizz,
        ]);
    }



    #[Route('/quizz/teste', name: 'app_quizz_front_teste')]
    public function teste(QuizzCategoriesRepository $quizzcategorierepository): Response
    {
        return $this->render('quizz/front/teste.html.twig', [
            'controller_name' => 'HomeController',
            // 'quizz' => $quizz,
            'categories' => $quizzcategorierepository->find(2),

        ]);
    }



}
