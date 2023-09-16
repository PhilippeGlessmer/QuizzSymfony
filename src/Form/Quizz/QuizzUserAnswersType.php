<?php

namespace App\Form\Quizz;

use App\Entity\Quizz\QuizzUserAnswers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuizzUserAnswersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('userQuizz')
            ->add('question')
            ->add('choice')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => QuizzUserAnswers::class,
        ]);
    }
}
