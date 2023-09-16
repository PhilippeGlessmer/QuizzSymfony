<?php

namespace App\Form\Quizz;

use App\Entity\Quizz\QuizzIllustrations;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuizzIllustrationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('file')
            ->add('quizz')
            ->add('question')
            ->add('reponses')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => QuizzIllustrations::class,
        ]);
    }
}
