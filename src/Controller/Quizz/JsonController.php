<?php

namespace App\Controller\Quizz;

use App\Entity\Quizz\Quizz;
use App\Entity\Quizz\QuizzChoices;
use App\Entity\Quizz\QuizzQuestions;
use App\Form\Quizz\QuizzType;
use App\Repository\Quizz\QuizzRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class JsonController extends AbstractController
{
    #[Route('/quizz/json', name: 'app_quizz_json')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createFormBuilder(null, [
            'action' => $this->generateUrl('app_quizz_json'),
        ])
            ->add('json', TextareaType::class, [
                'label' => 'JSON Data',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Create Quiz',
                'attr' => [
                    'class' => 'btn btn-success'
                ]
            ])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


                    $data = $form->getData();
            $jsonData = json_decode($data['json'], true);

            $quiz = new Quizz();
            $quiz->setTitle($jsonData['title']);
            $entityManager->persist($quiz);

            foreach ($jsonData['questions'] as $q) {
                $question = new QuizzQuestions();
                $question->setQuestion($q['question']);
                $question->setQuizz($quiz);
                $entityManager->persist($question);

                foreach ($q['choices'] as $c) {
                    $choice = new QuizzChoices();
                    $choice->setReponse($c['text']);
                    $choice->setIsCorrect($c['isCorrect']);
                    $choice->setQuestion($question);
                    $entityManager->persist($choice);
                }
            }

            $entityManager->flush();

        return $this->redirectToRoute('app_quizz_quizz_index'); // Remplacez par la route où vous souhaitez rediriger l'utilisateur
        }
        return $this->render('quizz/json/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
